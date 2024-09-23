<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function createTable(Request $request)
    {
        if (!Schema::hasTable($request->username . '_table')) {
            Schema::create($request->username . '_table', function (Blueprint $table) {
                $table->id('tbl_id');
                $table->integer('sender_id');
                $table->integer('receiver_id');
                $table->date('sent')->default(now());
                $table->longText('message')->nullable();
                $table->string('image')->nullable();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->enum('is_delete', [true, false])->default(false);
                $table->timestamps();
            });

            return response()->json([
                'status' => true,
                'message' => 'Table created successfully'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Table already exists'
        ], 203);
    }

    public function deleteTable(Request $request)
    {
        if (Schema::hasTable($request->username . '_table')) {
            Schema::dropIfExists($request->username . '_table');

            return response()->json([
                'status' => true,
                'message' => 'Table deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Table already deleted'
            ], 203);
        }
    }
}
