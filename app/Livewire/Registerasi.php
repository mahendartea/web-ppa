<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\Log;

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

    // Properties for select options
    public $regencies = [];
    public $districts = [];
    public $villages = [];

    public $provinceId;
    public $regencyId;
    public $districtId;
    public $villageId;

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

    public function updatedProvinsi($value)
    {
        // Reset dependent fields
        $this->regencies = [];
        $this->districts = [];
        $this->villages = [];
        $this->kotakab = null;
        $this->kecamatan = null;
        $this->desa = null;

        if (empty($value)) {
            return;
        }

        // Store the province ID directly
        $this->provinceId = $value;
        
        // Get the province name for display
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://emsifa.github.io/api-wilayah-indonesia/api/province/' . $this->provinceId . '.json');
        $province = json_decode($response->getBody()->getContents());
        
        // We don't need to update $this->provinsi here since we're using the ID directly
        // This was causing the select to revert to default option

        // Load regencies for the selected province
        $response = $client->request('GET', 'https://emsifa.github.io/api-wilayah-indonesia/api/regencies/' . $this->provinceId . '.json');
        $this->regencies = json_decode($response->getBody()->getContents());
        
        // Log for debugging
        Log::info('Regencies loaded for province ID: ' . $this->provinceId, [
            'count' => count($this->regencies),
            'first_few' => array_slice((array) $this->regencies, 0, 3)
        ]);
    }

    public function updatedKotakab($value)
    {
        // Reset dependent fields
        $this->districts = [];
        $this->villages = [];
        $this->kecamatan = null;
        $this->desa = null;

        if (empty($value)) {
            return;
        }

        // We don't need to set $this->kotakab = $value here as it's already set by Livewire

        // Find the regency ID by name from the loaded regencies
        if ($this->regencies && count($this->regencies) > 0) {
            foreach ($this->regencies as $regency) {
                if ($regency->name === $value) {
                    $this->regencyId = $regency->id;
                    break;
                }
            }

            // Load districts for the selected regency
            if ($this->regencyId) {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('GET', 'https://emsifa.github.io/api-wilayah-indonesia/api/districts/' . $this->regencyId . '.json');
                $this->districts = json_decode($response->getBody()->getContents());
                
                // Log for debugging
                Log::info('Districts loaded for regency ID: ' . $this->regencyId, [
                    'count' => count($this->districts),
                    'first_few' => array_slice((array) $this->districts, 0, 3)
                ]);
            }
        }
    }

    public function updatedKecamatan($value)
    {
        // Reset dependent fields
        $this->villages = [];
        $this->desa = null;

        if (empty($value)) {
            return;
        }

        // We don't need to set $this->kecamatan = $value here as it's already set by Livewire

        // Find the district ID by name
        if ($this->districts && count($this->districts) > 0) {
            foreach ($this->districts as $district) {
                if ($district->name === $value) {
                    $this->districtId = $district->id;
                    break;
                }
            }

            // Load villages for the selected district
            if ($this->districtId) {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('GET', 'https://emsifa.github.io/api-wilayah-indonesia/api/villages/' . $this->districtId . '.json');
                $this->villages = json_decode($response->getBody()->getContents());
                
                // Log for debugging
                Log::info('Villages loaded for district ID: ' . $this->districtId, [
                    'count' => count($this->villages),
                    'first_few' => array_slice((array) $this->villages, 0, 3)
                ]);
            }
        }
    }

    public function updatedDesa($value)
    {
        if (empty($value)) {
            return;
        }
        
        // We don't need to set $this->desa = $value here as it's already set by Livewire
        
        // Find the village ID by name if needed for future use
        if ($this->villages && count($this->villages) > 0) {
            foreach ($this->villages as $village) {
                if ($village->name === $value) {
                    $this->villageId = $village->id;
                    break;
                }
            }
            
            // Log for debugging
            if ($this->villageId) {
                Log::info('Village selected: ' . $value . ' with ID: ' . $this->villageId);
            }
        }
    }
    
    public function render()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
        $dataprov = json_decode($response->getBody()->getContents());

        return view('livewire.registerasi', compact('dataprov'));
    }
}
