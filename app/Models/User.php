<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Profile;
use App\Models\Guarantor;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,  HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    public function guarantor()
    {
        return $this->hasOne(Guarantor::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->type = $user->type ?? 'local'; // Set default value only if type is not provided
            $user->status = $user->status ?? 'pending'; // Set default value only if status is not provided
        });
    }


    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }




    // Assuming 'users' table has a 'member_id' column

    /**
     * Generate a unique member ID for a user.
     *
     * @param string $role The role of the user (e.g., 'ST' for student).
     * @param string $initial The first letter of the user's name.
     * @return string The unique member ID.
     */
    public static function generateUniqueMemberID($memberType, $initial, $institute)
    {
        if ($institute !== null && $institute !== '') {
            $universityCode = $institute;
        } else {
            $universityCode = 'RNTU';
        }
       // $universityCode = $institute ?? 'RNTU';
        $yearCode = date('y'); // Get the current year in two digits
        $roleCode = strtoupper($memberType); // Convert the role to uppercase
        $initial = strtoupper($initial); // Convert the initial to uppercase

        // Get the next unique number from the database
        $latestUser = self::latest()->first();
        $uniqueNumber = $latestUser ? $latestUser->id : 1;
        $uniqueNumber = str_pad($uniqueNumber, 5, '0', STR_PAD_LEFT); // Pad the unique number to 5 digits
        // Get the count of existing users

        // // Generate a UUID
        // $uuid = Str::uuid();
        // // Extract the first part of the UUID (assuming it's sufficiently unique)
        // $uniqueNumber = substr($uuid, 0, 5);
        // $uniqueNumber = str_pad($uniqueNumber, 5, '0', STR_PAD_LEFT); // Pad the unique number to 5 digits

        // // Get the count of existing users (including deleted) directly from the database
        // $userCount = DB::table('users')->count();
        // // Increment user count by 1 to get the next unique number
        // $uniqueNumber = $userCount + 1;
        // $uniqueNumber = str_pad($uniqueNumber, 5, '0', STR_PAD_LEFT); // Pad the unique number to 5 digits

        // Combine all parts to form the member ID
        return "{$universityCode}-{$yearCode}{$roleCode}{$uniqueNumber}{$initial}";
    }


    // // Example usage:
    // $role = 'ST'; // Role code for 'Student'
    // $initial = 'A'; // First letter of the user's name
    // $uniqueMemberID = User::generateUniqueMemberID($role, $initial);
    // echo $uniqueMemberID; // Outputs: RNTU-24-ST-00001-A
}
