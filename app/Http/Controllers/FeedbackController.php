<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    //
    public function showForm()
    {
        return view('feedback');
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:1000',
        ]);

        Feedback::create($request->only('name', 'email', 'rating', 'message'));

        return back()->with('success', 'Thank you for your feedback!');
    }

        public function list()
        {
            $feedbacks = Feedback::latest()->get();
            return view('admin.feedback_list', compact('feedbacks'));
        }

        public function delete($id)
        {
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();

            return back()->with('success', 'Feedback deleted successfully!');

        }
      
        public function showFeedbacks() {
            $feedbacks = Feedback::all(); // All feedbacks from the database
            return view('feedbacks', compact('feedbacks')); // Return the view with feedbacks
        }
        

}