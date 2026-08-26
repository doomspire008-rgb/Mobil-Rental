<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function testimonials()
    {
        $testimonials = Review::with('user', 'car')
            ->whereHas('booking', fn ($q) => $q->where('status', 'completed'))
            ->where('rating', '>=', 4)
            ->latest()
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $testimonials,
        ]);
    }

    public function store(Request $request, int $carId)
    {
        $booking = Booking::where('user_id', $request->user()->id)
            ->where('car_id', $carId)
            ->where('status', 'completed')
            ->whereDoesntHave('review')
            ->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Anda hanya bisa memberikan ulasan untuk booking yang sudah selesai',
            ], 422);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = Review::create([
            'user_id' => $request->user()->id,
            'car_id' => $carId,
            'booking_id' => $booking->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil dikirim',
            'data' => $review->load('user'),
        ], 201);
    }

    public function update(Request $request, int $id)
    {
        $review = Review::where('user_id', $request->user()->id)->findOrFail($id);
        
        $request->validate([
            'rating' => 'sometimes|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Ulasan diperbarui',
            'data' => $review->load('user'),
        ]);
    }

    public function destroy(Request $request, int $id)
    {
        $review = Review::where('user_id', $request->user()->id)->findOrFail($id);
        $review->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Ulasan dihapus',
        ]);
    }
}