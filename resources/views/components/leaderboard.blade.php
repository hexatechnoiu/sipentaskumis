    <div class="overflow-x-auto w-full h-[299px] py-4 bg-white rounded-lg shadow dark:bg-gray-800">
        <table class="w-full text-sm text-left     text-black    ">
            <thead class="text-sm     text-black     uppercase">
                <tr class="border-b">
                    <th scope="col" class="px-4 py-1">NO</th>
                    {{-- <th scope="col" class="px-4 py-1">Foto</th> --}}
                    <th scope="col" class="px-1 py-1">OSIS</th>
                    <th scope="col" class="px-4 py-1">VOTE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($osis as $os)
                    <tr class="">
                        <td class="px-1 py-1 text-center">{{ $os->nomor_urut }}.</td>
                        <td class="px-1 py-1 max-w-[12rem]">{{ $os->name }}</td>
                        <td class="px-1 py-1 text-center">{{ $os->vote->count() }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <div class="overflow-x-auto py-4 w-full h-[299px] bg-white rounded-lg shadow dark:bg-gray-800">
        <table class="w-full text-sm text-left     text-black    ">
            <thead class="text-sm     text-black     uppercase">
                <tr class="border-b">
                    <th scope="col" class="px-4 py-1">NO</th>
                    {{-- <th scope="col" class="px-4 py-1">Foto</th> --}}
                    <th scope="col" class="px-1 py-1">MPK</th>
                    <th scope="col" class="px-4 py-1">VOTE</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1 @endphp
                @foreach ($mpk as $m)
                    <tr>
                        <td class="px-1 py-1 text-center">{{ $i++ }}.</td>
                        {{-- <td class="px-4 py-1"><img class="flex justify-center items-center max-w-[28px] rounded-full" src="{{ asset('img/hafiz.webp') }}"></td> --}}
                        <td class="px-1 py-1 max-w-[10rem]">{{ $m->name }}</td>
                        <td class="px-1 py-1 text-center">{{ $m->vote->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
