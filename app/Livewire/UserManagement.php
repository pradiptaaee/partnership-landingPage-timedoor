<?php
namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Component
{
    use WithPagination;

    public $confirmingUserDeletion = false;
    public $userIdToDelete = null;

    public $name, $email, $password, $userId;
    public $isEdit = false;
    public $showModal = false; // State untuk mengontrol modal
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function openModal()
    {
        $this->resetInput();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->userId = null;
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // PERBAIKAN: Gunakan success-alert dan named argument 'message'
        $this->dispatch('success-alert', message: 'User baru berhasil ditambahkan!');

        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
        ]);

        $user = User::find($this->userId);
        $updateData = ['name' => $this->name, 'email' => $this->email];

        if ($this->password) {
            $updateData['password'] = Hash::make($this->password);
        }

        $user->update($updateData);

        // PERBAIKAN: Ganti session flash ke dispatch agar tidak perlu refresh halaman
        $this->dispatch('success-alert', message: 'Data user berhasil diperbarui.');

        $this->closeModal();
    }

    public function deleteUser()
    {
        $user = User::find($this->userIdToDelete);

        if ($user) {
            $user->delete();

            // 1. Ganti session()->flash() dengan Event Dispatch
            $this->dispatch('success-alert', message: 'user berhasil dihapus dari sistem.');

            // Reset state modal dan data
            $this->confirmingUserDeletion = false;
            $this->userIdToDelete = null;

            
        } else {
            // Jika gagal, bisa dispatch error event juga jika diinginkan
            // $this->dispatch('error-alert', message: 'Gagal menghapus User.');

            // Reset state modal
            $this->confirmingUserDeletion = false;
            $this->userIdToDelete = null;
        }

        $this->resetPage();
    }

    public function confirmUserDeletion($userId)
    {
        $this->confirmingUserDeletion = true;
        $this->userIdToDelete = $userId;
    }

    public function render()
    {
        return view('livewire.user-management', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->latest()->paginate(10)
        ]);
    }
}