<div class="p-4">
    <div class="w-full p-4 bg-white rounded shadow md:w-1/2 mx-auto">
        @if (session()->has('updated'))
        <div class="alert alert-info shadow-lg mb-4">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-current flex-shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session()->get('updated') }}</span>
            </div>
        </div>
        @endif
        <form wire:submit.prevent='update' class="w-full">
            <div class="w-full mb-4 form-control">
                @if ($profilePhoto != null)
                <div class="flex justify-center items-center mb-4 space-x-4">
                    <div class="w-[100px] h-[100px] rounded-full overflow-hidden bg-indigo-200">
                        <img src="{{ $profilePhoto->temporaryUrl() }}" alt="Avatar"
                            class="w-full h-full object-cover" />
                    </div>
                    <a wire:click='deleteProfilePhoto' class="btn btn-error text-white">Delete</a>
                </div>
                @else
                <div class="flex justify-center items-center mb-4 space-x-4">
                    <div class="w-[100px] h-[100px] rounded-full overflow-hidden bg-indigo-200">
                        <img src="{{ $user->profile_photo_url }}" alt="Avatar" class="w-full h-full object-cover" />
                    </div>
                </div>
                @endif
                <input wire:model='profilePhoto' type="file" class="w-full file-input" />
            </div>
            <div class="w-full mb-4 form-control">
                <label class="label">
                    <span class="label-text">Name</span>
                    @error('name')
                    <span class="label-text-alt">{{ $message }}</span>
                    @enderror
                </label>
                <input wire:model='user.name' type="text" placeholder="Enter your name"
                    class="w-full input input-bordered" />
            </div>
            <div class="w-full mb-4 form-control">
                <label class="label">
                    <span class="label-text">Email</span>
                    @error('email')
                    <span class="label-text-alt">{{ $message }}</span>
                    @enderror
                </label>
                <input wire:model='user.email' type="text" placeholder="Enter your email"
                    class="w-full input input-bordered" />
            </div>
            <div class="w-full mb-4 form-control">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
