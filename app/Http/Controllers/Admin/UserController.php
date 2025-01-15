<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'required|string|max:20',
                'type' => 'required|in:student,instructor,admin',
            ]);

            // تشفير كلمة المرور
            $validated['password'] = Hash::make($validated['password']);

            // إنشاء المستخدم
            $user = User::create($validated);

            if (!$user) {
                Log::error('Failed to create user', $validated);
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'حدث خطأ أثناء إنشاء المستخدم. يرجى المحاولة مرة أخرى.');
            }

            return redirect()->route('admin.users.index')
                ->with('success', 'تم إضافة المستخدم بنجاح');

        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء إنشاء المستخدم: ' . $e->getMessage());
        }
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|string|max:20',
                'type' => 'required|in:student,instructor,admin',
            ]);

            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'required|string|min:8|confirmed',
                ]);
                $validated['password'] = Hash::make($request->password);
            }

            $user->update($validated);

            return redirect()->route('admin.users.index')
                ->with('success', 'تم تحديث المستخدم بنجاح');

        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تحديث المستخدم: ' . $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.users.index')
                ->with('success', 'تم حذف المستخدم بنجاح');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء حذف المستخدم: ' . $e->getMessage());
        }
    }
}
