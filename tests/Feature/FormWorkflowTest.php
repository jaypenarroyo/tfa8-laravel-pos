<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Database\Seeders\PosSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class FormWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PosSeeder::class);
        $this->actingAs(User::where('username', 'admin')->firstOrFail());
    }

    public function test_a_customer_can_be_created_and_updated(): void
    {
        $this->post(route('customers.store'), [
            'full_name' => 'Leah Bautista',
            'email' => 'leah.bautista@example.com',
            'phone' => '0999-111-2233',
        ])->assertRedirect(route('customers.index'));

        $customer = Customer::where('email', 'leah.bautista@example.com')->firstOrFail();
        $this->assertSame('Leah Bautista', $customer->full_name);

        $this->put(route('customers.update', $customer), [
            'full_name' => 'Leah B. Bautista',
            'email' => 'leah.bautista@example.com',
            'phone' => '0999-111-2233',
        ])->assertRedirect(route('customers.index'));

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'full_name' => 'Leah B. Bautista',
        ]);
    }

    public function test_customer_validation_preserves_old_input(): void
    {
        $this->from(route('customers.create'))->post(route('customers.store'), [
            'full_name' => 'Leah Bautista',
            'email' => 'not-an-email',
            'phone' => '0999-111-2233',
        ])->assertRedirect(route('customers.create'))
            ->assertSessionHasErrors('email')
            ->assertSessionHasInput('full_name', 'Leah Bautista')
            ->assertSessionHasInput('email', 'not-an-email');
    }

    public function test_a_user_can_be_created_and_duplicate_usernames_are_rejected(): void
    {
        $this->post(route('users.store'), [
            'username' => 'supervisor01',
            'full_name' => 'Rina Castillo',
            'email' => 'supervisor01@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'username' => 'supervisor01',
            'full_name' => 'Rina Castillo',
        ]);

        $this->from(route('users.create'))->post(route('users.store'), [
            'username' => 'supervisor01',
            'full_name' => 'Another Supervisor',
            'email' => 'another@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors('username')
            ->assertSessionHasInput('full_name', 'Another Supervisor');
    }

    public function test_a_user_can_be_updated_with_a_prepared_avatar(): void
    {
        Storage::fake('public');
        $user = User::where('username', 'admin')->firstOrFail();
        $avatar = $this->imageUpload('profile.png', 600, 400, 500);

        $this->put(route('users.update', $user), [
            'username' => 'admin',
            'full_name' => 'Andrea Lim Updated',
            'email' => $user->email,
            'avatar' => $avatar,
        ])->assertRedirect(route('users.index'));

        $user->refresh();
        $this->assertSame('Andrea Lim Updated', $user->full_name);
        $this->assertNotNull($user->avatar);
        $this->assertStringEndsWith('.jpg', $user->avatar);
        Storage::disk('public')->assertExists($user->avatar);

        [$width, $height] = getimagesize(Storage::disk('public')->path($user->avatar));
        $this->assertSame(240, $width);
        $this->assertSame(240, $height);
        @unlink($avatar->getPathname());
    }

    public function test_avatar_validation_rejects_files_larger_than_two_megabytes(): void
    {
        Storage::fake('public');
        $user = User::where('username', 'admin')->firstOrFail();
        $avatar = $this->imageUpload('large.png', 100, 100, 3072);

        $this->from(route('users.edit', $user))->put(route('users.update', $user), [
            'username' => $user->username,
            'full_name' => $user->full_name,
            'email' => $user->email,
            'avatar' => $avatar,
        ])->assertRedirect(route('users.edit', $user))
            ->assertSessionHasErrors('avatar');

        $this->assertNull($user->fresh()->avatar);
        @unlink($avatar->getPathname());
    }

    private function imageUpload(string $name, int $width, int $height, int $kilobytes): UploadedFile
    {
        $directory = storage_path('framework/testing');

        if (! is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $path = $directory.'/'.Str::uuid().'-'.$name;
        $image = imagecreatetruecolor($width, $height);
        imagepng($image, $path);
        imagedestroy($image);

        $targetSize = $kilobytes * 1024;
        $currentSize = filesize($path);

        if ($currentSize < $targetSize) {
            file_put_contents($path, str_repeat("\0", $targetSize - $currentSize), FILE_APPEND);
        }

        clearstatcache(true, $path);

        return new UploadedFile($path, $name, 'image/png', null, true);
    }
}
