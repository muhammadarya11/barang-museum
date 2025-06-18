<?php

namespace App\Http\Controllers;

use App\Models\KoleksiBarang;
use App\Models\LaporanStatistik;
use App\Models\LokasiBarang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;

class PageController extends Controller
{
    public function dashboard()
    {
        $jumlahKoleksi = KoleksiBarang::count();
        $jumlahLokasi = LokasiBarang::count();
        $jumlahUser = User::count();
        $laporanBulanan = LaporanStatistik::count();

        $kategoriData = KoleksiBarang::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        $kategoriLabels = $kategoriData->keys();
        $kategoriCounts = $kategoriData->values();

        $lokasiData = KoleksiBarang::join('lokasi_barang', 'koleksi_barang.id_lokasi', '=', 'lokasi_barang.id_lokasi')
            ->select('lokasi_barang.nama_lokasi', DB::raw('count(*) as total'))
            ->groupBy('lokasi_barang.nama_lokasi')
            ->pluck('total', 'lokasi_barang.nama_lokasi');

        $lokasiLabels = $lokasiData->keys();
        $lokasiCounts = $lokasiData->values();

        return view('admin.home', compact(
            'jumlahKoleksi',
            'jumlahLokasi',
            'jumlahUser',
            'laporanBulanan',
            'kategoriLabels',
            'kategoriCounts',
            'lokasiLabels',
            'lokasiCounts'
        ));
    }

    public function lokasi_barang(Request $request)
    {
        $query = LokasiBarang::query();

        if ($request->filled('cari')) {
            $keyword = $request->cari;
            $query->where('nama_lokasi', 'like', "%{$keyword}%")
                ->orWhere('deskripsi', 'like', "%{$keyword}%");
        }

        $data = $query->get();

        return view('admin.lokasi', compact('data'));
    }

    public function tambah_lokasi()
    {
        $lokasi = LokasiBarang::all();
        return view('admin.tambah_lokasi', compact('lokasi'));
    }

    public function simpan_lokasi(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        LokasiBarang::create($request->only(['nama_lokasi', 'deskripsi']));

        return redirect()->route('dashboard')->with('notifikasi', [
            'icon' => 'plus-circle-fill',
            'color' => 'primary',
            'message' => 'Lokasi berhasil ditambahkan!'
        ]);
    }

    public function edit_lokasi($id)
    {
        $lokasi = LokasiBarang::findOrFail($id);
        return view('admin.edit_lokasi', compact('lokasi'));
    }

    public function update_lokasi(Request $request, $id)
    {
        $lokasi = LokasiBarang::findOrFail($id);

        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $lokasi->update($request->only(['nama_lokasi', 'deskripsi']));

        return redirect()->route('dashboard')->with('notifikasi', [
            'icon' => 'pencil-square',
            'color' => 'warning',
            'message' => 'Lokasi berhasil diperbarui!'
        ]);
    }

    public function hapus_lokasi($id)
    {
        $lokasi = LokasiBarang::findOrFail($id);
        $lokasi->delete();

       return redirect()->route('dashboard')->with('notifikasi', [
        'icon' => 'trash-fill',
        'color' => 'danger',
        'message' => 'Lokasi berhasil dihapus!'
    ]);

    }

    public function koleksi_barang(Request $request)
    {
        $query = KoleksiBarang::with('lokasi');

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_koleksi', 'like', '%' . $request->cari . '%')
                    ->orWhere('asal_koleksi', 'like', '%' . $request->cari . '%')
                    ->orWhere('kategori', 'like', '%' . $request->cari . '%')
                    ->orWhere('tahun_perolehan', 'like', '%' . $request->cari . '%');
            });
        }

        $data = $query->get();

        return view('admin.koleksi', compact('data'));
    }

    public function tambah_koleksi()
    {
        $lokasi = LokasiBarang::all();
        return view('admin.tambah_koleksi', compact('lokasi'));
    }

    public function simpan_koleksi(Request $request)
    {

        $request->validate([
            'nama_koleksi' => 'required|string|max:255',
            'asal_koleksi' => 'nullable|string|max:255',
            'tahun_perolehan' => 'nullable|integer',
            'deskripsi' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'id_lokasi' => 'nullable|exists:lokasi_barang,id_lokasi',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['nama_koleksi', 'asal_koleksi', 'tahun_perolehan', 'deskripsi', 'kategori', 'id_lokasi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('koleksi_gambar', 'public');
        }

        KoleksiBarang::create($data);

        return redirect()->route('dashboard')->with('notifikasi', [
            'icon' => 'plus-circle-fill',
            'color' => 'primary',
            'message' => 'koleksi berhasil ditambahkan!'
        ]);
    }

    public function edit_koleksi($id)
    {
        $koleksi = KoleksiBarang::findOrFail($id);
        $lokasiList = LokasiBarang::all();

        return view('admin.edit_koleksi', compact('koleksi', 'lokasiList'));
    }

    public function update_koleksi(Request $request, $id)
    {
        $koleksi = KoleksiBarang::findOrFail($id);

        $validated = $request->validate([
            'nama_koleksi' => 'required|string|max:255',
            'asal_koleksi' => 'nullable|string|max:255',
            'tahun_perolehan' => 'nullable|integer',
            'deskripsi' => 'nullable|string|max:255',
            'kategori' => 'required|string|max:100',
            'id_lokasi' => 'nullable|exists:lokasi_barang,id_lokasi',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('koleksi_gambar', 'public');
        }

        $koleksi->update($validated);

        return redirect()->route('dashboard')->with('notifikasi', [
            'icon' => 'pencil-square',
            'color' => 'warning',
            'message' => 'Koleksi berhasil diperbarui!'
        ]);
    }

    public function hapus_koleksi($id)
    {
        $item = KoleksiBarang::findOrFail($id);
        $item->delete();

         return redirect()->route('dashboard')->with('notifikasi', [
        'icon' => 'trash-fill',
        'color' => 'danger',
        'message' => 'Koleksi berhasil dihapus!'
    ]);
    }

    public function detail_koleksi($id)
    {
        $data = KoleksiBarang::with('lokasi')->findOrFail($id);
        return view('pengunjung.detail_koleksi', compact('data'));
    }

    public function laporan_statistik(Request $request)
    {
        $query = LaporanStatistik::query();

        if ($request->filled('cari')) {
            $keyword = $request->cari;
            $query->where('judul_laporan', 'like', "%{$keyword}%")
                ->orWhere('deskripsi', 'like', "%{$keyword}%");
        }

        $data = $query->get();

        return view('admin.laporan', compact('data'));
    }


    public function tambah_laporan()
    {
        return view('admin.tambah_laporan');
    }

    public function simpan_laporan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = [
            'tanggal_laporan' => $request->tanggal,
            'judul_laporan' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('file_laporan')) {
            $file = $request->file('file_laporan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/laporan'), $filename);
            $data['file_laporan'] = $filename;
        }

        LaporanStatistik::create($data);

        return redirect()->route('dashboard')->with('notifikasi', [
            'icon' => 'plus-circle-fill',
            'color' => 'primary',
            'message' => 'laporan berhasil ditambahkan!'
        ]);
    }

    public function edit_laporan($id)
    {
        $laporan = LaporanStatistik::findOrFail($id);
        return view('admin.edit_laporan', compact('laporan'));
    }

    public function update_laporan(Request $request, $id)
    {
        $laporan = LaporanStatistik::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('file_laporan')) {
            $file = $request->file('file_laporan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/laporan'), $filename);
            $data['file_laporan'] = $filename;
        }

        $laporan->update($data);

        return redirect()->route('dashboard')->with('notifikasi', [
            'icon' => 'pencil-square',
            'color' => 'warning',
            'message' => 'Koleksi berhasil diperbarui!'
        ]);
    }

    public function hapus_laporan($id)
    {
        $laporan = LaporanStatistik::findOrFail($id);
        $laporan->delete();

        return redirect()->route('dashboard')->with('notifikasi', [
        'icon' => 'trash-fill',
        'color' => 'danger',
        'message' => 'Laporan berhasil dihapus!'
        ]);
    }

public function dashboard_pengunjung()
{
    $koleksi = KoleksiBarang::all()->map(function ($item) {
        return [
            'id_koleksi' => $item->id_koleksi,
            'nama_koleksi' => $item->nama_koleksi,
            'gambar' => $item->gambar ?? 'default.jpg',
        ];
    });

$berita = [
    [
        'judul' => 'Sejarah RI Ditulis Ulang Jelang 80 Tahun Merdeka',
        'deskripsi' => 'Menjelang peringatan 80 tahun kemerdekaan Republik Indonesia, pemerintah melalui Kementerian Kebudayaan tengah menjalankan proyek ambisius, penulisan ulang sejarah nasional.',
        'tanggal' => '2025-06-08',
        'gambar' => 'berita1.jpg',
        'link' => 'https://www.rri.co.id/lain-lain/1505910/sejarah-ri-ditulis-ulang-jelang-80-tahun-merdeka',
    ],
    [
        'judul' => 'Penemuan Artefak Baru di Situs Candi Borobudur',
        'deskripsi' => 'Patahan kaki arca Siwa berhasil ditemukan dalam tanah di kawasan Borobudur Kabupaten Magelang. Potongan yang terpisah lebih dari 50 tahun tersebut juga berhasil disatukan dengan bagian lainnya.',
        'tanggal' => '2023-08-31',
        'gambar' => 'berita2.jpg',
        'link' => 'https://www.beritamagelang.id/terpendam-50-tahun-potongan-arca-siwa-ditemukan-di-kawasan-candi-borobudur',
    ],
    [
        'judul' => 'Dinas Kebudayaan Provinsi DKI Jakarta Selenggarakan Festival Museum dan Sejarah Jakarta 2024',
        'deskripsi' => 'Festival ini menjadi acara perdana yang dilaksanakan Pemerintah Provinsi DKI Jakarta melalui Dinas Kebudayaan yang terdiri dari rangkaian kegiatan yaitu, seminar nasional, pameran yang didukung dengan teknologi digital dan desain kekinian, bazar buku sejarah, talkshow, dan pengenalan destinasi wisata Jakarta.',
        'tanggal' => '2024-10-20',
        'gambar' => 'berita3.jpg',
        'link' => 'https://www.jxboard.co.id/news/dinas-kebudayaan-provinsi-dki-jakarta-selenggarakan-festival-museum-dan-sejarah-jakarta-2024',
    ],
];

    return view('pengunjung.dashboard_pengunjung', compact('koleksi', 'berita'));
}


    public function detail_koleksi_pengunjung($id)
    {
        $item = KoleksiBarang::find($id);

        if (!$item) {
            abort(404);
        }

        $data = [
            'nama_koleksi' => $item->nama_koleksi,
            'gambar' => $item->gambar ?? 'default.jpg',
            'kategori' => $item->kategori,
            'asal_koleksi' => $item->asal_koleksi,
            'tahun' => $item->tahun_perolehan,
            'deskripsi' => $item->deskripsi ?? 'Deskripsi belum tersedia'
        ];

        return view('pengunjung.detail_koleksi_pengunjung', ['item' => $data]);
    }

    public function koleksi_pengunjung(Request $request)
    {
        $search = $request->input('cari'); // disamakan dengan name="cari" di form
        $koleksiQuery = KoleksiBarang::query();

        if ($search) {
            $koleksiQuery->where('nama_koleksi', 'like', '%' . $search . '%')
                        ->orWhere('asal_koleksi', 'like', '%' . $search . '%')
                        ->orWhere('kategori', 'like', '%' . $search . '%');
        }

        $koleksi = $koleksiQuery->get();

        return view('pengunjung.koleksi_pengunjung', compact('koleksi'));
    }


    public function tentang_museum()
    {
    return view('pengunjung.about'); 
    }
    
public function boot()
{
    Blade::component('components.footer', 'footer');
    Blade::component('components.alert', 'alert'); 
}
}
