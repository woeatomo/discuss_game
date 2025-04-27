<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use FFMpeg;

class VideoController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi|max:51200', // Max 50MB
        ]);

        $video = $request->file('video');

        // Simpan video ke storage
        $path = $video->store('videos', 'public');

        // Tambahkan watermark
        $outputPath = 'videos/watermarked/' . $video->hashName();
        FFMpeg::fromDisk('public')
            ->open($path)
            ->addFilter(function ($filters) {
                $filters->watermark(public_path('watermark.png'), [
                    'position' => 'relative',
                    'bottom' => 10,
                    'right' => 10,
                ]);
            })
            ->export()
            ->toDisk('public')
            ->save($outputPath);

        // Simpan data video di database
        $video = Video::create([
            'user_id' => auth()->id(),
            'path' => $outputPath,
        ]);

        return response()->json(['message' => 'Video uploaded successfully', 'video' => $video], 201);
    }
}