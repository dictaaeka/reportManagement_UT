<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PdfCompressorService
{
    /**
     * Kualitas kompresi Ghostscript.
     *
     * screen   -> 72 dpi, paling kecil, kualitas paling rendah (jelek buat dibaca)
     * ebook    -> 150 dpi, seimbang antara ukuran & kualitas (RECOMMENDED buat laporan)
     * printer  -> 300 dpi, ukuran lebih besar, kualitas cetak
     * prepress -> 300 dpi, warna paling akurat, ukuran paling besar
     */
    protected string $quality;

    public function __construct(string $quality = 'ebook')
    {
        $this->quality = $quality;
    }

    /**
     * Cek apakah Ghostscript ter-install & bisa dipanggil.
     */
    public function isAvailable(): bool
    {
        $binary = config('services.ghostscript.path');

        if (empty($binary)) {
            return false;
        }

        try {
            $process = new Process([$binary, '--version']);
            $process->run();

            return $process->isSuccessful();
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Kompres file PDF. Return true kalau berhasil & hasil lebih kecil,
     * false kalau gagal/Ghostscript gak ada/hasil malah lebih besar.
     *
     * File input akan DITIMPA dengan hasil kompresi kalau berhasil.
     */
    public function compress(string $absolutePath): bool
    {
        if (! $this->isAvailable()) {
            Log::info('Ghostscript tidak tersedia, lewati kompresi PDF.', [
                'file' => $absolutePath,
            ]);

            return false;
        }

        if (! file_exists($absolutePath)) {
            return false;
        }

        $originalSize = filesize($absolutePath);
        $tempOutput = $absolutePath . '.compressed.tmp';
        $binary = config('services.ghostscript.path');

        try {
            $process = new Process([
                $binary,
                '-sDEVICE=pdfwrite',
                '-dCompatibilityLevel=1.4',
                "-dPDFSETTINGS=/{$this->quality}",
                '-dNOPAUSE',
                '-dQUIET',
                '-dBATCH',
                '-sOutputFile=' . $tempOutput,
                $absolutePath,
            ]);

            $process->setTimeout(120);
            $process->run();

            if (! $process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            if (! file_exists($tempOutput)) {
                return false;
            }

            $compressedSize = filesize($tempOutput);

            // Kalau hasil kompresi malah lebih besar/sama, buang & pakai file asli.
            if ($compressedSize >= $originalSize) {
                unlink($tempOutput);

                Log::info('Kompresi PDF tidak menghasilkan ukuran lebih kecil, file asli dipertahankan.', [
                    'file' => $absolutePath,
                    'original_size' => $originalSize,
                    'compressed_size' => $compressedSize,
                ]);

                return false;
            }

            // Timpa file asli dengan hasil kompresi.
            rename($tempOutput, $absolutePath);

            Log::info('PDF berhasil dikompres.', [
                'file' => $absolutePath,
                'original_size' => $originalSize,
                'compressed_size' => $compressedSize,
                'saved_percent' => round((1 - ($compressedSize / $originalSize)) * 100, 1),
            ]);

            return true;
        } catch (\Throwable $e) {
            Log::warning('Gagal mengompres PDF, file asli dipertahankan.', [
                'file' => $absolutePath,
                'error' => $e->getMessage(),
            ]);

            if (file_exists($tempOutput)) {
                @unlink($tempOutput);
            }

            return false;
        }
    }
}