<div class="container px-6 py-14 mx-auto">

    <section class="md:mt-28">

        <h1 class="text-2xl font-semibold text-center text-[#040181] capitalize lg:text-3xl dark:text-white">
            Formulir Pendaftaran </h1>

        <div class="flex justify-center mx-auto mt-6 mb-10">
            <span class="inline-block w-40 h-1 bg-[#040181] rounded-full"></span>
            <span class="inline-block w-3 h-1 mx-1 bg-[#040181] rounded-full"></span>
            <span class="inline-block w-1 h-1 bg-[#040181] rounded-full"></span>
        </div>

        @if (session()->has('success'))
            <div id="alert-additional-content-3"
                class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                role="alert">
                <div class="flex items-center">
                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <h3 class="text-lg font-medium capitalize">{{ session('success') }}</h3>
                </div>
                <div class="mt-2 text-sm text-wrap">
                    Pendaftaran keanggotaan Partai Perjuangan Aceh yang telah anda daftarkan akan segera kami proses.
                    Segera
                    kami hubungi anda melalui email maupun telepon.
                    Terima kasih,
                    <span class="font-semibold block mt-3 md:mt-10 text-[#040181]">Partai Perjuangan Aceh</span>
                </div>
            </div>
        @else
            <form wire:submit="save">
                <div class="md:grid md:grid-cols-2 md:gap-6 flex flex-col gap-5">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="name">
                            Nama Lengkap
                            <sup class="text-red-500"> * </sup>
                        </label>
                        <input wire:model="name" type="text" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="nickname">
                            Nama Panggilan
                        </label>
                        <input wire:model="nickname" type="text" id="nickname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukkan nama panggilan">
                        @error('nickname')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="ktp">KTP
                            <sup class="text-red-500"> * </sup>
                        </label>
                        <input wire:model="ktp" value="{{ old('ktp') }}"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="ktp" type="file" />
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or
                            GIF
                            (MAX. 800x400px) atau pdf (MAX. 2MB)</p>
                        @error('ktp')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo
                            (File Upload) <sup> * </sup></label>
                        <input type="file" id="photo" wire:model="photo" value="{{ old('photo') }}"
                            class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or
                            GIF
                            (MAX. 800x400px dan 2Mb) </p>
                        @error('photo')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2 bg-yellow-100 px-4 py-3 border border-yellow-400 rounded">
                        <div class="flex items-center mt-3">
                            <input type="checkbox" id="is_conf_ktp_addr_valid" wire:model.lazy="is_conf_ktp_addr_valid"
                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="is_conf_ktp_addr_valid"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-white">
                                Apakah saat ini anda bertempat tinggal di daerah Kabupaten/Kota sesuai dengan KTP-el ?
                            </label>
                            @error('is_conf_ktp_addr_valid')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <small class="ml-2 block text-xs text-red-500 mt-2 px-5">Pilih cek untuk menampilkan Pengisian
                            formulir
                            lengkap</small>
                    </div>

                    <hr class="my-6 border-yellow-500 dark:border-yellow-700 col-span-2">

                    @if ($is_conf_ktp_addr_valid)
                        <div>
                            <label for="kta_old"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                KTA Lama
                            </label>
                            <input type="text" id="kta_old" wire:model.lazy="kta_old"
                                class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('kta_old') }}" />
                            @error('kta_old')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="kta_new"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                KTA Baru <sup> * </sup></label>
                            <input type="text" id="kta_new" wire:model.lazy="kta_new" value="{{ old('kta_new') }}"
                                class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            @error('kta_new')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="couple_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Istri / Suami <sup> * </sup></label>
                            <input type="text" id="couple_name" wire:model.lazy="couple_name"
                                value="{{ old('couple_name') }}"
                                class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <div>
                            <label for="pekerjaan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan</label>
                            <select id="pekerjaan" wire:model="pekerjaan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">-- Pilih Pekerjaan --</option>
                                <option value="Pelajar Mahasiswa">Pelajar Mahasiswa</option>
                                <option value="Profesional">Profesional</option>
                                <option value="Pegawai Swasta">Pegawai Swasta</option>
                                <option value="Wirausaha">Wirausaha</option>
                                <option value="Buruh">Buruh</option>
                                <option value="Pensiunan">Pensiunan</option>
                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                <option value="Petani">Petani</option>
                                <option value="Nelayan">Nelayan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('pekerjaan')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_education"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Pendidikan
                                Terakhir <sup> * </sup></label>
                            <select id="last_education" wire:model="last_education"
                                class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">-- Pilih Pendidikan Terakhir --</option>
                                <option value="SD">SD</option>
                                <option value="SMP /Sederajat">SMP /Sederajat</option>
                                <option value="SMA /Sederajat">SMA /Sederajat</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('last_education')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                Kontak (HP/WA) <sup> * </sup></label>
                            <input type="number" id="phone" wire:model.lazy="telp"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required
                                value="{{ old('telp') }}" />
                            @error('telp')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <hr class="my-6 border-yellow-500 dark:border-yellow-700 col-span-2">
                        <div>
                            <label for="recomend_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Pemberi
                                Rekomandasi <sup> * </sup></label>
                            <input type="text" id="recomend_name" wire:model.lazy="recomend_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Budiawan" value="{{ old('recomend_name') }}" />
                            @error('recomend_name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="recomend_jabatan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Jabatan
                                Pemberi Rekomendasi <sup> * </sup></label>
                            <input type="text" id="recomend_jabatan" wire:model.lazy="recomend_jabatan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Pimpinan Partai" value="{{ old('recomend_jabatan') }}" />
                            @error('recomend_jabatan')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="recomend_telp"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                Kontak
                                Pemberi Rekomendasi <sup> * </sup></label>
                            <input type="number" id="recomend_telp" wire:model.lazy="recomend_telp"
                                value="{{ old('recomend_telp') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" />
                            @error('recomend_telp')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <hr class="my-6 border-yellow-500 dark:border-yellow-700 col-span-2">

                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                <sup> * </sup></label>
                            <input type="email" id="email" wire:model.lazy="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="john.doe@company.com" required value="{{ old('email') }}" />
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="social_media"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Media Sosial
                                <sup>
                                    * </sup></label>
                            <select id="social_media" wire:model.lazy="social_media"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Pilih Media Sosial</option>
                                <option value="facebook">Facebook</option>
                                <option value="instagram">Instagram</option>
                                <option value="tiktok">Tiktok</option>
                            </select>
                            @error('social_media')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="social_media_link"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Media
                                Sosial
                                <sup>
                                    * </sup></label>
                            <input type="text" id="social_media_link" wire:model.lazy="social_media_link"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="https://www.facebook.com/johndoe" required
                                value="{{ old('social_media_link') }}" />
                            @error('social_media_link')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <hr class="my-6 border-yellow-500 dark:border-yellow-700 col-span-2">

                        <div>
                            <label for="level_pengurusan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level Pengurusan
                                <sup> * </sup></label>
                            <select id="level_pengurusan" wire:model.lazy="level_pengurusan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Pilih Level Pengurusan</option>
                                <option value="DPP">DPP</option>
                                <option value="DPD PROV.">DPD PROV.</option>
                                <option value="DPD KAB/ KOTA">DPD KAB/ KOTA</option>
                                <option value="PK">PK</option>
                                <option value="KEC.">KEC.</option>
                                <option value="PL">PL</option>
                                <option value="DS/ KEL.">DS/ KEL.</option>
                            </select>
                            @error('level_pengurusan')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jabatan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan
                                Pekerjaan <sup> * </sup></label>
                            <select id="jabatan" wire:model.lazy="jabatan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Pilih Jabatan</option>
                                <option value="KETUA">KETUA</option>
                                <option value="SEKRETARIS">SEKRETARIS</option>
                                <option value="BENDAHARA">BENDAHARA</option>
                                <option value="HARIAN">HARIAN</option>
                                <option value="PLENO">PLENO</option>
                            </select>
                            @error('jabatan')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="provinsi">
                                <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Wilayah DPD
                                    Provinsi <sup> * </sup></span>
                            </label>
                            <select id="provinsi" wire:model.lazy="provinsi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Pilih Provinsi</option>
                                @foreach($dataprov as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kotakab"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Wilayah DPD Kabupaten/Kota <sup> * </sup></label>
                            <select id="kotakab" wire:model.lazy="kotakab" {{ empty($regencies) ? 'disabled' : '' }}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Pilih Kabupaten/Kota</option>
                                @foreach($regencies as $regency)
                                    <option value="{{ $regency->name }}">{{ $regency->name }}</option>
                                @endforeach
                            </select>
                            @error('kotakab')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kecamatan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Wilayah DPD Kecamatan <sup> * </sup></label>
                            <select id="kecamatan" wire:model.lazy="kecamatan" {{ empty($districts) ? 'disabled' : '' }}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Pilih Kecamatan</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->name }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            @error('kecamatan')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="desa"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Wilayah DPD Desa <sup> * </sup></label>
                            <select id="desa" wire:model.lazy="desa" {{ empty($villages) ? 'disabled' : '' }}
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Pilih Desa</option>
                                @foreach($villages as $village)
                                    <option value="{{ $village->name }}">{{ $village->name }}</option>
                                @endforeach
                            </select>
                            @error('desa')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <hr class="my-6 border-yellow-500 dark:border-yellow-700 col-span-2">

                </div>
                <div class="col-span-2 bg-yellow-100 px-4 py-3 border border-yellow-400 rounded mb-2">
                    <div class="mt-2 text-sm text-wrap text-yellow-800">
                        <input type="checkbox" class="mr-2" wire:model.lazy="agreement">
                        <span class="block sm:inline">
                            Dengan sukarela dan penuh kesadaran bersama ini saya mengajukan permohonan untuk didaftarkan
                            sebagai anggota Partai Perjuangan Aceh. Saya menyatakan bahwa semua data yang saya sampaikan
                            dalam Formulir Pendaftaran ini adalah benar sebagai bukti pendaftaran dan pendataan yang sah
                            serta dapat digunakan sebagaimana mestinya. Saya tidak dan tidak akan mendaftarkan diri
                            sebagai anggota Partai Politik lainnya selain dan hanya Partai Perjuangan Aceh. Saya
                            berjanji dengan sungguh-sungguh bahwa saya menerima dan sanggup mengamalkan Doktrin,
                            Anggaran Dasar, Anggaran Rumah Tangga, Program Umum, Peraturan Organisasi, dan Ikrar Partai
                            Perjuangan Aceh, serta aktif dalam kegiatan Partai Perjuangan Aceh. Apabila di kemudian hari
                            saya melanggar Doktrin, Ikrar, Anggaran Dasar, Anggaran Rumah Tangga, Program Umum,
                            Peraturan dan Kebijakan Organisasi Partai Perjuangan Aceh, maka saya bersedia diberhentikan
                            dari keanggotaan Partai Perjuangan Aceh sesuai dengan ketentuan yang berlaku.
                        </span>
                        <span class="font-semibold block mt-3 md:mt-5 text-[#040181]">Partai Perjuangan Aceh</span>
                    </div>
                </div>
                <button type="submit" {{ $agreement ? '' : 'disabled' }}
                    class="text-white float-right {{ $agreement ? 'bg-blue-700' : 'bg-gray-400' }} hover:bg-blue-800
                focus:ring-4
                focus:outline-none
                focus:ring-blue-300
                 font-medium rounded-lg text-sm w-full sm:w-auto px-7 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Daftar
                </button>
                @if ($errors->any())
                    <p
                        class="mt-2 text-sm text-red-600 dark:text-red-500 bg-red-200 max-w-md px-2 rounded text-center float-right mr-5 capitalize">
                        Ada kesalahan
                        input,
                        cek kembali
                        form di
                        atas!</p>
                @endif
        @endif
        </form>
        @endif
    </section>
</div>
