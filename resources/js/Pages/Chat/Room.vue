<template>
    <div class="flex h-screen flex-col">
        <div class="flex-1 overflow-y-scroll bg-gray-200">
            <div class="px-4 py-2">
                <div class="mb-2 flex items-center">
                    <img
                        class="mr-2 h-8 w-8 rounded-full"
                        src="https://picsum.photos/50/50"
                        alt="User Avatar"
                    />
                    <div class="font-medium">John Doe</div>
                </div>
                <div class="mb-2 max-w-sm rounded-lg bg-white p-2 shadow">
                    Hi, how can I help you?
                </div>
                <div class="flex items-center justify-end">
                    <div
                        class="mr-2 max-w-sm rounded-lg bg-blue-500 p-2 text-white shadow"
                    >
                        Sure, I can help with that.
                    </div>
                    <img
                        class="h-8 w-8 rounded-full"
                        src="https://picsum.photos/50/50"
                        alt="User Avatar"
                    />
                </div>
            </div>
        </div>
        <div class="bg-gray-100 px-4 py-2">
            <div class="flex items-center">
                <input
                    class="mr-2 w-full rounded-full border px-4 py-2"
                    type="text"
                    placeholder="Type your message..."
                />
                <button
                    class="rounded-full bg-blue-500 px-4 py-2 font-medium text-white hover:bg-blue-700"
                >
                    Send
                </button>
            </div>
        </div>
    </div>
</template>
