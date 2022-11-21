<div class="p-4">
    @if (session()->has('success'))
    <div class="w-full mb-4">
        <div class="alert alert-info shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-current flex-shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session()->get('success') }}</span>
            </div>
        </div>
    </div>
    @endif
    <div class="w-full flex justify-between items-center py-2">
        <a href="{{ route('user.create') }}" class="btn btn-primary">Create New User!</a>
        <div class="form-control">
            <div class="input-group">
                <input wire:model='search' id="search" type="text" placeholder="Search…" class="input input-bordered" />
                <label class="btn btn-square" for="search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </label>
            </div>
        </div>
    </div>
    <div class="w-full overflow-x-auto">
        <table class="table w-full mb-16">
            <!-- head -->
            <thead>
                <tr>
                    <th>
                        <label>
                            <input wire:model='all' type="checkbox" class="checkbox" wire:click='selectAll' />
                        </label>
                    </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr wire:key='{{ bcrypt($user->name) }}'>
                    <th>
                        <label>
                            @if (auth()->user()->isNot($user))
                            <input wire:model='selected' value="{{ $user->id }}" type="checkbox" class="checkbox" />
                            @endif
                        </label>
                    </th>
                    <td>
                        <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <div class="w-24 h-24 rounded-full border-2 border-indigo-200">
                                    <img src="{{ $user->profile_photo_url }}" alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">{{ $user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-ghost badge-lg">{{ $user->email }}</span>
                    </td>
                    <th>
                        <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                            class="text-indigo-500 btn btn-ghost btn-xs">edit</a>
                        <!-- The button to open modal -->
                        @if (auth()->user()->isNot($user))
                        <label for="deleteAllModal-{{ $user->id }}"
                            class="text-rose-500 btn btn-ghost btn-xs">delete</label>
                            @endif

                        <!-- Put this part before </body> tag -->

                    </th>
                </tr>
                <input type="checkbox" id="deleteAllModal-{{ $user->id }}" class="modal-toggle" />
                <div class="modal w-full">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">{{ $user->name }}</h3>
                        <p class="py-4">Do you really want to delete this user?
                            This process cannot be undone.</p>
                        <div class="modal-action">
                            <label wire:click='deleteUser({{ $user->id }})' for="deleteAllModal-{{ $user->id }}"
                                class="btn btn-error text-white">Delete!</label>
                            <label for="deleteAllModal-{{ $user->id }}" class="btn btn-success">Cancel!</label>
                        </div>
                    </div>
                </div>
                @empty
                <tr></tr>
                @endforelse

            </tbody>
        </table>
        <div class="w-full">
            {{ $users->links() }}
        </div>
    </div>
    @if ($selected != null)
    <div class="w-full fixed bottom-0 left-0 z-50 flex justify-end p-4 items-center space-x-2 bg-indigo-200 rounded-t-md shadow">
        {{-- <span>{{ $selected }}</span> --}}
        <span>{{ count($selected) }} selected user(s)</span>
        <!-- The button to open modal -->
        <label for="deleteAllModal" class="btn btn-error text-white">delete {{ count($selected) }} user(s)</label>

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="deleteAllModal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Delete Selected User(s)</h3>
                <p class="py-4">Do you really want to delete these user(s)?
                    This process cannot be undone.</p>
                <div class="modal-action">
                    <label wire:click='multiDelete' for="deleteAllModal" class="btn btn-error text-white">Delete!</label>
                    <label for="deleteAllModal" class="btn">Cancel!</label>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
