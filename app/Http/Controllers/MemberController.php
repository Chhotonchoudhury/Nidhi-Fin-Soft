<?php

namespace App\Http\Controllers;
use App\Models\Memeber;
use App\Models\Branch;
use App\Models\User;
use App\Models\ShareRange;
use App\Models\Share;
use App\Models\AuthorizedCapital;
use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function index(Request $request)
    {
        $search = $request->input('search', ''); // Capture search query
    
        // Apply search query and paginate
        $members = Memeber::when($search, function ($query, $search) {
            return $query->where('member_code', 'like', "%{$search}%")
                         ->orWhere('first_name', 'like', "%{$search}%")
                         ->orWhere('middle_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%");
        })
        ->paginate(50); // Paginate results per page
    
        return view('members.list', compact('members', 'search'));
    }

    public function MemberForm($id = null)
    {
        $branches = Branch::all();
        $users = User::whereIn('user_type', ['Employee', 'Agent'])->get();

        if ($id) {
            // Fetch the agent data for editing
            $member = Memeber::findOrFail($id);
            return view('members.storeFrom', ['member' => $member, 'branches' => $branches, 'users' => $users]);
        } else {
            // For creating a new agent
            return view('members.storeFrom', ['branches' => $branches, 'users' => $users]);
        }
    }
    public function storeOrUpdateMember(StoreMemberRequest $request, $id = null)
    {
        // Find member by ID or create a new instance
        $member = $id ? Memeber::findOrFail($id) : new Memeber();

        // Assign validated data to the member model
        $member->user_id  = $request->user_id;
        $member->branch_id = $request->branch_id;
        $member->application_number = $request->application_number;
        $member->gender  = $request->gender; // Add gender column
        $member->title = $request->title;
        $member->first_name = $request->first_name;
        $member->middle_name = $request->middle_name;
        $member->last_name = $request->last_name;
        $member->date_of_birth = $request->date_of_birth;
        $member->occupation = $request->occupation;
        $member->annual_income = $request->annual_income;
        $member->monthly_income = $request->monthly_income;
        $member->father_name = $request->father_name;
        $member->mother_name = $request->mother_name;
        $member->husband_spouse = $request->husband_spouse;
        $member->marital_status = $request->marital_status;
        $member->enrollment_date = $request->enrollment_date;
        $member->ex_service_person =  $request->has('ex_service_person');
        $member->email = $request->email;
        $member->email_is_active = $request->has('email_is_active');
        $member->mobile_number = $request->mobile_number;
        $member->mobile_is_active = $request->has('mobile_is_active');
        $member->aadhaar_number = $request->aadhaar_number;
        $member->voter_id = $request->voter_id;
        $member->pan_number = $request->pan_number;
        $member->ration_card_number = $request->ration_card_number;
        $member->meter_number = $request->meter_number;
        $member->ci_number = $request->ci_number;
        $member->ci_relation = $request->ci_relation;
        $member->dl_number = $request->dl_number;

        // Assign Bank Details
        $member->bank_name = $request->bank_name;
        $member->bank_code = $request->bank_code;
        $member->account_type = $request->account_type;
        $member->account_number = $request->account_number;
        $member->ifsc_code = $request->ifsc_code;
        $member->branch_name = $request->branch_name;

        // Correspondence Address
        $member->correspondence_address_line1 = $request->correspondence_address_line1;
        $member->correspondence_address_line2 = $request->correspondence_address_line2;
        $member->para = $request->para;
        $member->panchayat = $request->panchayat;
        $member->ward = $request->ward;
        $member->area = $request->area;
        $member->landmark = $request->landmark;
        $member->city = $request->city;
        $member->state = $request->state;
        $member->pincode = $request->pincode;
        $member->country = $request->country;

        // Permanent Address
        $member->permanent_address = $request->permanent_address;
        $member->permanent_city = $request->permanent_city;
        $member->permanent_state = $request->permanent_state;
        $member->permanent_pincode = $request->permanent_pincode;
        $member->use_as_communication_address = $request->has('use_as_communication_address');

        // Address Geolocation
        $member->address_latitude = $request->address_latitude;
        $member->address_longitude = $request->address_longitude;

        // Nominee Details
        $member->nominee_name = $request->nominee_name;
        $member->nominee_relation = $request->nominee_relation;
        $member->nominee_mobile_number = $request->nominee_mobile_number;
        $member->nominee_aadhaar_number = $request->nominee_aadhaar_number;
        $member->nominee_voter_id = $request->nominee_voter_id;
        $member->nominee_pan_number = $request->nominee_pan_number;
        $member->nominee_ration_card_number = $request->nominee_ration_card_number;
        $member->nominee_address = $request->nominee_address;

        // Alerts and Notifications
        $member->enable_sms_alert = $request->has('enable_sms_alert');

        // Handle photo file upload (delete old photo if updating)
        if ($request->hasFile('photo')) {
            if ($id && $member->photo) {
                \Storage::disk('public')->delete($member->photo); // Delete old photo
            }
            $member->photo = $request->file('photo')->store('members', 'public');
        }

        // Handle signature file upload (delete old signature if updating)
        if ($request->hasFile('signature')) {
            if ($id && $member->signature) {
                \Storage::disk('public')->delete($member->signature); // Delete old signature
            }
            $member->signature = $request->file('signature')->store('memberSing', 'public');
        }

        // Handle driving license file upload (delete old driving license if updating)
        if ($request->hasFile('driving_license')) {
            if ($id && $member->driving_license) {
                \Storage::disk('public')->delete($member->driving_license); // Delete old driving license
            }
            $member->driving_license = $request->file('driving_license')->store('memberDocuments', 'public');
        }

        // Handle PAN card file upload (delete old PAN card if updating)
        if ($request->hasFile('pan_card')) {
            if ($id && $member->pan_card) {
                \Storage::disk('public')->delete($member->pan_card); // Delete old PAN card
            }
            $member->pan_card = $request->file('pan_card')->store('memberDocuments', 'public');
        }

        // Handle Aadhaar card file upload (delete old Aadhaar card if updating)
        if ($request->hasFile('aadhar_card')) {
            if ($id && $member->aadhar_card) {
                \Storage::disk('public')->delete($member->aadhar_card); // Delete old Aadhaar card
            }
            $member->aadhar_card = $request->file('aadhar_card')->store('memberDocuments', 'public');
        }


        // Handle optional documents and store them as JSON
        if ($request->has('document_type') && $request->has('document')) {
            $documents = $member->documents ? json_decode($member->documents, true) : [];

            foreach ($request->document_type as $index => $type) {
                $file = $request->file('document')[$index];
                $filePath = $file->store('documents', 'public');

                $documents[] = [
                    'doc_type' => $type,
                    'file_path' => $filePath,
                ];
            }

            // Save updated documents as JSON
            $member->documents = json_encode($documents);
        }

        // Set default member status
        $member->status = $request->status; // Default status can be active or based on your logic

        // Save the member
        $member->save();


         // Allocate shares for the new member (if a new member is created)
        if (!$id) {
            // Fetch the share range for the member type
            $shareRange = ShareRange::where('user_type', 'Member')->where('active', true)->first();

            if ($shareRange) {
                // Calculate the number of shares to allocate
                $minShares = $shareRange->min_shares;
                $maxShares = $shareRange->max_shares;
                $sharesToAllocate = $minShares;

                if ($maxShares - $minShares > 1) {
                    $sharesToAllocate = floor(($minShares + $maxShares) / 2);
                }

                // Fetch the last issued share range
                $lastIssuedShare = Share::orderBy('share_range_end', 'desc')->first();
                $lastShareEnd = $lastIssuedShare ? (int)$lastIssuedShare->share_range_end : 0;

                // Determine the new range
                $newShareStart = $lastShareEnd + 1;
                $newShareEnd = $newShareStart + $sharesToAllocate - 1;

                // Ensure available shares in authorized capitals
                $availableShares = AuthorizedCapital::first()->available_shares;

                if ($sharesToAllocate > $availableShares) {
                    return redirect()->route('member.index')->with('success', 'Member created successfully, but shares not allocated due to insufficient available shares.');
                }

                // Update the authorized_capitals table
                $authorizedCapital = AuthorizedCapital::first();
                $authorizedCapital->issued_shares += $sharesToAllocate;
                $authorizedCapital->available_shares -= $sharesToAllocate;
                $authorizedCapital->save();

                // Create the share record for the member
                Share::create([
                    'shareholder_type' => 'App\Models\Member',
                    'shareholder_id' => $member->id,
                    'share_range_start' => $newShareStart,
                    'share_range_end' => $newShareEnd,
                    'nominal_value' => $authorizedCapital->nominal_value,
                    'number_of_shares' => $sharesToAllocate,
                    'purchase_price' => $authorizedCapital->nominal_value * $sharesToAllocate,
                    'share_type' => 'issued',
                    'date' => now(),
                    'status' => 'active',
                    'is_paid' => false,
                ]);
            }
        }

        return redirect()->route('member.index')->with('success', $id ? 'Member updated successfully' : 'Member created successfully');
    }

}
