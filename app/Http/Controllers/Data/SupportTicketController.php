<?php

namespace App\Http\Controllers\Data;

use App\Models\TicketReply;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\TicketAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SupportTicketController extends Controller
{
    //
    // public function index()
    // {
    //     $supportTickets = SupportTicket::latest()->paginate(10); // Get all support tickets
    //     return view('manage.supports.index', compact('supportTickets'));
    // }

    // public function index(Request $request)
    // {
    //     // Base query to fetch support tickets
    //     $ticketsQuery = SupportTicket::query();
    //     // $ticketsQuery = SupportTicket::latest();

    //     // Apply filters based on request parameters if provided
    //     if ($request->filled('status')) {
    //         $ticketsQuery->where('status', $request->status)->latest();
    //     }
    //     if ($request->filled('category')) {
    //         $ticketsQuery->where('category', $request->category)->latest();
    //     }

    //     // Fetch all tickets if no filters are applied
    //     $filteredTickets = $ticketsQuery->paginate(10);

    //     // Fetch counts for each status
    //     $allCount = SupportTicket::all()->count();
    //     $openCount = SupportTicket::where('status', 'open')->count();
    //     $pendingCount = SupportTicket::where('status', 'pending')->count();
    //     $closedCount = SupportTicket::where('status', 'closed')->count();
    //     $draftCount = SupportTicket::where('status', 'draft')->count();

    //     // Fetch all categories
    //     $categories = SupportTicket::pluck('category')->unique();

    //     // Fetch category-wise counts if filters are not applied
    //     if (!$request->filled('status') && !$request->filled('category')) {
    //         $categoryCounts = $ticketsQuery->select('category', \DB::raw('count(*) as count'))
    //             ->groupBy('category')
    //             ->get()
    //             ->pluck('count', 'category');
    //     } else {
    //         $categoryCounts = null;
    //     }

    //     return view('manage.supports.index', compact('openCount', 'closedCount', 'draftCount', 'categories', 'categoryCounts', 'filteredTickets', 'allCount', 'pendingCount'));
    // }

    public function index(Request $request)
    {
        // Base query to fetch support tickets
        $ticketsQuery = SupportTicket::latest();

        // Apply filters based on request parameters if provided
        if ($request->filled('status')) {
            $ticketsQuery->where('status', $request->status);
        }
        if ($request->filled('category')) {
            $ticketsQuery->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $searchQuery = $request->search;
            $ticketsQuery->where(function ($query) use ($searchQuery) {
                $query->where('ticket_id', 'like', "%$searchQuery%")
                    ->orWhere('category', 'like', "%$searchQuery%")
                    ->orWhere('subject', 'like', "%$searchQuery%")
                    ->orWhere('message', 'like', "%$searchQuery%");
            });
        }

        // Fetch all tickets if no filters are applied
        $filteredTickets = $ticketsQuery->paginate(10);

        // Fetch counts for each status
        $allCount = SupportTicket::count();
        $openCount = SupportTicket::where('status', 'open')->count();
        $pendingCount = SupportTicket::where('status', 'pending')->count();
        $closedCount = SupportTicket::where('status', 'closed')->count();
        $draftCount = SupportTicket::where('status', 'draft')->count();

        // Fetch all categories
        $categories = SupportTicket::pluck('category')->unique();

        // Fetch category-wise counts if filters are not applied
        $categoryCounts = null;
        if (!$request->filled('status') && !$request->filled('category')) {
            $categoryCounts = SupportTicket::select('category', \DB::raw('count(*) as count'))
                ->groupBy('category')
                ->get()
                ->pluck('count', 'category');
        }

        return view('manage.supports.index', compact('openCount', 'closedCount', 'draftCount', 'categories', 'categoryCounts', 'filteredTickets', 'allCount', 'pendingCount'));
    }


    public function open()
    {
        $supportTickets = SupportTicket::where('status', 'open')->latest()->paginate(10);

        return view('manage.supports.index', compact('supportTickets'));
    }

    // public function show($ticket_id)
    // {
    //     try {
    //         // Retrieve the support ticket by ticket_id
    //         $supportTicket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();

    //         // Retrieve the user related to the support ticket
    //         $user = $supportTicket->user;

    //         // Fetch attachments related to the support ticket
    //         $attachments = $supportTicket->attachments;

    //         // Fetch conversation messages (support ticket messages and replies)
    //         $conversation = [];

    //         // Add support ticket message to the conversation
    //         $conversation[] = [
    //             'user' => $user->name ?? 'Unknown', // Assuming user has a 'name' attribute
    //             'timestamp' => $supportTicket->created_at->format('Y-m-d H:i:s'), // Format timestamp as needed
    //             'message' => $supportTicket->message,
    //             'attachments' => $attachments, // Attachments for the support ticket message
    //         ];

    //         // Fetch replies for the support ticket
    //         // $replies = $supportTicket->replies()->orderBy('created_at')->get();
    //         $replies = TicketReply::where('support_ticket_id', $supportTicket->ticket_id)
    //             ->orderBy('created_at')
    //             ->get();

    //         // Add replies to the conversation
    //         foreach ($replies as $reply) {
    //             $replyUser = $reply->user ?? null;
    //             $replyAttachments = $reply->attachments ?? [];

    //             $conversation[] = [
    //                 'user' => $replyUser ? $replyUser->name : 'Unknown', // Assuming reply user has a 'name' attribute
    //                 'timestamp' => $reply->created_at->format('Y-m-d H:i:s'), // Format timestamp as needed
    //                 'message' => $reply->reply,
    //                 'attachments' => $replyAttachments, // Attachments for the reply
    //             ];
    //         }

    //         return view('manage.supports.show', compact('supportTicket', 'attachments', 'user', 'conversation'));
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'An error occurred while processing your request.');
    //     }
    // }

    public function show($ticket_id)
    {
        try {
            // Retrieve the support ticket by ticket_id
            $supportTicket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();
            // $supportTicket = SupportTicket::with('attachments')->where('ticket_id', $ticket_id)->firstOrFail();

            // Retrieve the user related to the support ticket
            $user = $supportTicket->user;
      
            // Fetch conversation messages (support ticket messages and replies)
            $conversation = [];

            // Add support ticket message to the conversation
            $supportAttachmentsArray = [];
            foreach ($supportTicket->attachments as $attachment) {
                $supportAttachmentsArray[] = $attachment;
            }

            $conversation[] = [
                'user' => $user->name ?? 'Unknown',
                'timestamp' => $supportTicket->created_at->format('d M Y H:i A'),
                'message' => $supportTicket->message,
                'attachments' => $supportAttachmentsArray,
            ];

            // Fetch replies for the support ticket
            $replies = TicketReply::where('ticket_id', $supportTicket->ticket_id)
                ->orderBy('created_at')
                ->get();

            // Add replies to the conversation
            foreach ($replies as $reply) {
                $replyUser = $reply->user ?? null;
                $replyAttachmentsArray = [];
                foreach ($reply->attachments as $attachment) {
                    $replyAttachmentsArray[] = $attachment;
                }

                $conversation[] = [
                    'user' => $replyUser ? $replyUser->name : 'Unknown',
                    'timestamp' => $reply->created_at->format('d M Y H:i A'),
                    'message' => $reply->reply,
                    'attachments' => $replyAttachmentsArray,
                ];
            }

            $categories = SupportTicket::pluck('category')->unique();
            // Fetch counts for each status
            $allCount = SupportTicket::all()->count();
            $openCount = SupportTicket::where('status', 'open')->count();
            $pendingCount = SupportTicket::where('status', 'pending')->count();
            $closedCount = SupportTicket::where('status', 'closed')->count();
            $draftCount = SupportTicket::where('status', 'draft')->count();

            // Pass the conversation data to the view
            return view('manage.supports.show', compact('supportTicket', 'user', 'conversation', 'categories', 'allCount', 'openCount', 'closedCount', 'draftCount', 'pendingCount'));
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    // public function show($ticket_id)
    // {


    //     $supportTicket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();
    //     $user = $supportTicket->user;
    //     $attachments = $supportTicket->attachments;

    //     // Fetch conversation messages (support ticket messages and replies)
    //     $conversation = [];

    //     // Add support ticket message to the conversation
    //     $conversation[] = [
    //         'user' => $user->name, // Assuming user has a 'name' attribute
    //         'timestamp' => $supportTicket->created_at->format('Y-m-d H:i:s'), // Format timestamp as needed
    //         'message' => $supportTicket->message,
    //         'attachments' => $attachments, // Attachments for the support ticket message
    //     ];

    //     // Fetch replies for the support ticket
    //     // $replies = $supportTicket->replies()->orderBy('created_at')->get();
    //     // Fetch replies for the support ticket
    //     $replies = TicketReply::where('support_ticket_id', $supportTicket->ticket_id)
    //         ->orderBy('created_at')
    //         ->get();

    //     // Add replies to the conversation
    //     foreach ($replies as $reply) {
    //         $conversation[] = [
    //             'user' => $reply->user->name, // Assuming reply user has a 'name' attribute
    //             'timestamp' => $reply->created_at->format('Y-m-d H:i:s'), // Format timestamp as needed
    //             'message' => $reply->reply,
    //             'attachments' => $reply->attachments, // Attachments for the reply
    //         ];
    //     }

    //     return view('manage.supports.show', compact('supportTicket', 'attachments', 'user', 'conversation'));
    // }
    public function reply(Request $request, $ticket_id)
    {
        $request->validate([
            'reply' => 'required|string',
            'attachments.*' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048', // Adjust validation rules as needed
        ], [
            'reply.required' => 'Please enter a reply message.',
            'attachments.*.mimes' => 'Only JPG, JPEG, PNG, and PDF files are allowed.',
            'attachments.*.max' => 'Attachments must not exceed 2MB in size.',
        ]);


        try {
            DB::beginTransaction();

            $supportTicket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();


            $reply = new TicketReply();
            $reply->ticket_id = $ticket_id;
            $reply->user_id = auth()->id(); // Assuming admin is authenticated

            $reply->reply = $request->reply;

            $reply->save();

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    if ($file->isValid()) {
                        $fileName = $file->getClientOriginalName();
                        $filePath = $file->store('attachments', 'public');

                        $attachment = new TicketAttachment();
                        $attachment->ticket_id = $ticket_id;
                        $attachment->attachable_type = TicketReply::class;
                        $attachment->attachable_id = $reply->id;
                        $attachment->file_name = $fileName;
                        $attachment->file_path = $filePath;
                        $attachment->save();
                    } else {
                        throw new \Exception('Failed to upload attachment: ' . $file->getErrorMessage());
                    }
                }
            }

            $supportTicket->status = 'Replied';
            $supportTicket->save();

            DB::commit();

            return redirect()->back()->with('success', 'Reply sent successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Reply failed: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to send reply. Please try again later.');
        }
    }

    public function destroy($ticket_id)
    {

        try {
            $supportTicket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();
            $supportTicket->delete();
            return redirect()->route('support-tickets.index')->with('success', 'Ticket deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('support-tickets.index')->with('error', 'Failed to delete ticket.');
        }
    }

    // public function reply(Request $request, $ticket_id)
    // {
    //     $request->validate([
    //         'reply' => 'required|string',
    //         'attachments.*' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048', // Adjust validation rules as needed
    //     ], [
    //        // 'reply.required' => 'Please enter a reply message.',
    //         'attachments.*.mimes' => 'Only JPG, JPEG, PNG, and PDF files are allowed.',
    //         'attachments.*.max' => 'Attachments must not exceed 2MB in size.',
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         $supportTicket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();

    //         $reply = new TicketReply();
    //         $reply->support_ticket_id = $supportTicket->ticket_id;

    //         // Retrieve the user ID from the currently authenticated user
    //         $reply->user_id = auth()->id();

    //         $reply->reply = $request->reply;
    //         // dd($reply);
    //         $reply->save();

    //         // Handle attachments ...

    //         $supportTicket->status = 'Replied';
    //         $supportTicket->save();

    //         DB::commit();

    //         return redirect()->back()->with('success', 'Reply sent successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->with('error', 'Failed to send reply. Please try again later.');
    //     }
    // }

    // public function reply(Request $request, $ticket_id)
    // {

    //     $request->validate([
    //         'reply' => 'required|string',
    //         // 'attachments.*' => 'nullable|mimes:pdf,docx|max:2048', // Validate attachment files
    //         'attachments.*' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048', // Adjust validation rules as needed
    //     ]);


    //     // $ticket = SupportTicket::findOrFail($id); // Find the support ticket by ticket_id
    //     $supportTicket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();


    //     // Create ticket reply
    //     $reply = new TicketReply();
    //     $reply->support_ticket_id = $supportTicket->ticket_id;
    //     $reply->user_id = auth()->id(); // Assuming admin is authenticated
    //     $reply->reply = $request->reply;
    //     $reply->save();

    //     // Handle attachments
    //     if ($request->hasFile('attachments')) {
    //         foreach ($request->file('attachments') as $file) {
    //             $fileName = $file->getClientOriginalName();
    //             $filePath = $file->store('attachments');

    //             // Create attachment record associated with the reply
    //             $attachment = new TicketAttachment();
    //             $attachment->support_ticket_id = $supportTicket->id;
    //             $attachment->ticket_reply_id = $reply->id; // Associate with the reply
    //             $attachment->file_name = $fileName;
    //             $attachment->file_path = $filePath;
    //             $attachment->save();
    //         }
    //     }

    //     // Update support ticket status or other information
    //     $supportTicket->status = 'Replied';
    //     $supportTicket->save();

    //     return redirect()->back()->with('success', 'Reply sent successfully.');
    // }
}
