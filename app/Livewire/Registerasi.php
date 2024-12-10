<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Registerasi extends Component
{
    use WithFileUploads;

    public $name;
    public $nickname;
    public $ktp;
    public $photo;
    public $is_conf_ktp_addr_valid = true;
    public $kta_old;
    public $kta_new;
    public $couple_name;
    public $last_education;
    public $recomend_name;
    public $recomend_jabatan;
    public $recomend_telp;
    public $social_media;
    public $social_media_link;
    public $level_pengurusan;
    public $jabatan;
    public $provinsi;
    public $kotakab;
    public $kecamatan;
    public $desa;
    public $pekerjaan;

    public $agreement;

    public function save()
    {
        $this->validate([
           'name' => 'required|string|max:255',
           'nickname' => 'nullable|string|max:255',
           'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
           'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
           'is_conf_ktp_addr_valid' => 'required|boolean',
           'kta_old' => 'nullable|string|max:255',
           'kta_new' => 'nullable|string|max:255',
           'couple_name' => 'nullable|string|max:255',
           'last_education' => 'nullable|string|max:255',
           'recomend_name' => 'nullable|string|max:255',
           'recomend_jabatan' => 'nullable|string|max:255',
           'recomend_telp' => 'nullable|numeric|digits_between:10,15',
           'social_media' => 'nullable|string|max:255',
           'social_media_link' => 'nullable|string|max:255',
           'level_pengurusan' => 'nullable|string|max:255',
           'jabatan' => 'nullable|string|max:255',
           'provinsi' => 'nullable|string|max:255',
           'kotakab' => 'nullable|string|max:255',
           'kecamatan' => 'nullable|string|max:255',
           'desa' => 'nullable|string|max:255',
           'pekerjaan' => 'nullable|string|max:255',
        ]);


        $member = Member::create([
           'name' => $this->name,
           'nickname' => $this->nickname,
           'ktp' => $this->ktp->hashName(),
           'foto' => $this->photo->hashName(),
           'is_conf_ktp_addr_valid' => $this->is_conf_ktp_addr_valid ? 1 : 0,
           'kta_old' => $this->kta_old,
           'kta_new' => $this->kta_new,
           'couple_name' => $this->couple_name,
           'last_education' => $this->last_education,
           'recomend_name' => $this->recomend_name,
           'recomend_jabatan' => $this->recomend_jabatan,
           'recomend_telp' => $this->recomend_telp,
           'social_media' => $this->social_media,
           'social_media_link' => $this->social_media_link,
           'level_pengurusan' => $this->level_pengurusan,
           'jabatan' => $this->jabatan,
           'provinsi' => $this->provinsi,
           'kotakab' => $this->kotakab,
           'kecamatan' => $this->kecamatan,
           'desa' => $this->desa,
           'pekerjaan' => $this->pekerjaan,
        ]);

        if ($this->photo) {
            $path = $this->photo->store('photos', 'public');
            $member->update([
               'foto' => $path,
            ]);
        }

        if ($this->ktp) {
            $path = $this->ktp->store('ktp', 'public');
            $member->update([
               'ktp' => $path,
            ]);
        }
        return redirect()->route('registerasi')->with('success', 'Data berhasil Dikirim!');
    }

    public function render()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $dataprov = json_decode($response->getBody()->getContents());

        return view('livewire.registerasi', compact('dataprov'));
    }
}
