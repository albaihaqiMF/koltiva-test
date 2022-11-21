<div class="p-4">
    <div class="w-full p-4 bg-white rounded shadow md:w-1/2">
        <form wire:submit.prevent='create' class="w-full">
            <div class="w-full mb-4 form-control">
                <label class="label label-text">Profile Photo</label>
                @if ($profilePhoto != null)
                <div class="flex justify-center items-center mb-4 space-x-4">
                    <div class="w-[100px] h-[100px] mask mask-squircle">
                        <img src="{{ $profilePhoto->temporaryUrl() }}" alt="Avatar" class="w-full h-full object-cover" />
                    </div>
                    <a wire:click='deleteProfilePhoto' class="btn btn-error text-white">Delete</a>
                </div>
                @endif
                <input wire:model='profilePhoto' type="file" class="w-full file-input" />
            </div>
            <div class="w-full mb-4 form-control">
                <label class="label">
                    <span class="label-text">Name</span>
                    @error('name')
                    <span class="label-text-alt text-red-500">{{ $message }}</span>
                    @enderror
                </label>
                <input wire:model='name' type="text" placeholder="Enter your name"
                    class="w-full input input-bordered" />
            </div>
            <div class="w-full mb-4 form-control">
                <label class="label">
                    <span class="label-text">Email</span>
                    @error('email')
                    <span class="label-text-alt text-red-500">{{ $message }}</span>
                    @enderror
                </label>
                <input wire:model='email' type="text" placeholder="Enter your email"
                    class="w-full input input-bordered" />
            </div>
            <div class="w-full mb-4 form-control">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
