<?php

namespace App\Http\Controllers;

use App\Models\TicketReply;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\TicketAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\SupportTicketAttachment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewSupportTicketNotification;



class SupportController extends Controller
{
    // Display all support tickets of the current user
    // public function index()
    // {

    //     $user = Auth::user();
    //     // $supportTickets = $user->supportTickets()->latest()->paginate(10); // Get user's support tickets
    //     $supportTickets = $user->supportTickets()->latest()->paginate(10); // Get user's support tickets
    //     // Fetch unique categories from support tickets
    //     $categories = $supportTickets->pluck('category')->unique();
    //     $statuses = $supportTickets->pluck('status')->unique();
    //     return view('common.support.index', compact('supportTickets', 'categories', 'statuses'));
    // }

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->supportTickets()->latest();
    
        // Apply category filter
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
    
        // Apply status filter
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
    
        $supportTickets = $query->paginate(10); // Paginate after applying filters
    
        // Fetch unique categories and statuses from filtered support tickets
        $categories = $user->supportTickets()->pluck('category')->unique();
        $statuses = $user->supportTickets()->pluck('status')->unique();
    
        return view('common.support.index', compact('supportTickets', 'categories', 'statuses'));
    }

    public function open()
    {
        $user = Auth::user();
        
        // Fetch support tickets where the status is "open"
        $supportTickets = $user->supportTickets()->where('status', 'open')->latest()->paginate(10);
    
        // Fetch unique categories and statuses from filtered support tickets
        $categories = $user->supportTickets()->pluck('category')->unique();
        $statuses = $user->supportTickets()->pluck('status')->unique();
        
        return view('common.support.index', compact('supportTickets', 'categories', 'statuses'));
    }

    // Display the form to create a new support ticket
    public function create()
    {
        return view('common.support.create');
    }
    // Store a newly created support ticket
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'category' => 'required',
                'subject' => 'required',
                'message' => 'required',
                'attachments.*' => 'mimes:jpg,jpeg,png,pdf|max:2048', // Adjust validation rules as needed
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $ticket = new SupportTicket();
            $ticket->user_id = Auth::id();
            $ticket->category = $request->category;
            $ticket->subject = $request->subject;
            $ticket->message = $request->message;
            $ticket->status = 'open';
            // $ticket->ticket_id = uniqid(); // Generating a unique ticket ID
            $ticket->ticket_id = rand(100000, 999999); // Generate a random 4-digit ticket ID
            $ticket->save();

            // Handle attachments
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $fileName = $file->getClientOriginalName();
                    $filePath = $file->store('attachments', 'public');

                    // Create attachment record
                    $attachment = new TicketAttachment();
                    $attachment->ticket_id = $ticket->ticket_id;
                    $attachment->attachable_type = SupportTicket::class;
                    $attachment->attachable_id = $ticket->id;
                    $attachment->file_name = $fileName;
                    $attachment->file_path = $filePath;
                    $attachment->save();
                }
            }

            // Notify admins about new ticket
            // Notification::route('mail', config('mail.admin_email'))
            //     ->notify(new NewSupportTicketNotification($ticket));

            return redirect()->back()->with('success', 'Ticket submitted successfully. Your ticket ID is: ' . $ticket->ticket_id);
        } catch (\Exception $e) {
            // Log the exception
            // logger()->error($e->getMessage());

            // Return error message
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    // Display the specified support ticket for the current user
    // public function show($ticket_id)
    // {
    //     // $user = User::with('supportTickets')->find($user_id);
    //     // Retrieve the support ticket by ticket_id
    //     $supportTicket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();
    //     // $ticket = Ticket::findOrFail($ticket_id);
    //     // Retrieve the user related to the support ticket
    //     $user = $supportTicket->user;
    //     // Fetch attachments related to the support ticket
    //     $attachments = $supportTicket->attachments;

    //     // Pass the support ticket and its attachments to the view
    //     return view('manage.supports.show', compact('supportTicket', 'attachments', 'user'));
    // }

    public function show($ticket_id)
    {

        try {
            // Retrieve the support ticket by ticket_id
            $supportTicket = SupportTicket::where('ticket_id', $ticket_id)->firstOrFail();

            // Retrieve the user related to the support ticket
            $user = $supportTicket->user;

            // Fetch conversation messages (support ticket messages and replies)
            $conversation = [];

            // Add support ticket message to the conversation
            $supportAttachments = $supportTicket->attachments;

            $supportAttachmentsArray = [];
            foreach ($supportAttachments as $attachment) {
                $supportAttachmentsArray[] = $attachment;
            }

            $conversation[] = [
                'user' => $user->name ?? 'Unknown',
                'timestamp' => $supportTicket->created_at->format('d M Y, h:i A'),
                'message' => $supportTicket->message,
                'attachments' => $supportAttachmentsArray,
            ];


            // Fetch replies for the support ticket
            $replies = TicketReply::where('ticket_id', $ticket_id)
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

            return view('common.support.show', compact('supportTicket', 'user', 'conversation'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    public function downloadAttachment($id)
    {
        $attachment = TicketAttachment::findOrFail($id);
        return response()->download(storage_path("app/{$attachment->file_path}"));
    }

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
                        $attachment->attachable_type = TicketReply::class;
                        $attachment->ticket_id = $ticket_id;
                        $attachment->attachable_id = $reply->id;
                        $attachment->file_name = $fileName;
                        $attachment->file_path = $filePath;
                        $attachment->save();
                    } else {
                        throw new \Exception('Failed to upload attachment: ' . $file->getErrorMessage());
                    }
                }
            }

            $supportTicket->status = 'Open';
            $supportTicket->save();

            DB::commit();

            return redirect()->back()->with('success', 'Reply sent successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Reply failed: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to send reply. Please try again later.');
        }
    }
}
