<?php

namespace App\Http\Controllers;

use App\Models\ContactList;
use App\Models\TableList;
use App\Models\User;
use Illuminate\Http\Request;

class ContactListController extends Controller
{

    public function getContact(string $id)
    {
        try {
            $contact_list = ContactList::with('users')->where('usr_id', '=', $id)->get();

            return response()->json([
                'status' => true,
                'data' => $contact_list
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function createContact(Request $request)
    {
        try {
            $contact = User::where('phone', '=', '0' . $request->phone)->first();
            $new_contact = null;
            if ($contact) {
                $new_contact = ContactList::create([
                    'contact_id' => $contact->id,
                    'usr_id' => $request->usr_id,
                    'nickname' => $request->nickname,
                    'phone' =>  $contact->phone,
                    'status' => 'active',
                    'is_delete' => 'false',
                ]);
            }

            if ($new_contact) {

                $connect = TableList::where([
                    'member_id_1' => $request->usr_id,
                    'member_id_2' => $contact->id
                ])->orWhere([
                    'member_id_1' => $contact->id,
                    'member_id_2' => $request->usr_id
                ])->get();

                if ($connect) {
                    TableList::create([
                        'member_id_1' => $request->usr_id,
                        'member_id_2' => $contact->id,
                        'table_name' => $request->usr_id . '_' . $contact->id,
                        'status' => 'active',
                        'is_delete' => 'false'
                    ]);
                } else {
                    return;
                }
            }

            return response()->json([
                'status' => true,
                'data' => $new_contact,
                'message' => 'Contact created successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
