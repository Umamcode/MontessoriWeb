<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container mt-4">
        {{-- Ucapan Selamat Datang --}}
        <div class="text-center mb-4">
            <img src={{ asset('assets/logo-2.png') }} style="width: 15em;">
            <h2 class="text-primary">Selamat Datang di Sistem Perpustakaan Ibbadurrahman Montessori School</h2>
            <p class="text-muted">Temukan dan kelola berbagai koleksi buku dengan mudah dan cepat.</p>
        </div>

        {{-- Kartu Statistik --}}
        @include('components.layouts.card', [
            'member' => $member,
            'buku' => $buku,
            'pinjam' => $pinjam,
            'pengembalian' => $pengembalian,
        ])

        {{-- Panduan Penggunaan --}}
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                Panduan Penggunaan Sistem
            </div>
            <div class="card-body">
                <ul>
                    <li><strong>Tambah Buku:</strong> Admin dapat menambahkan koleksi buku baru melalui menu "Kelola
                        Buku".</li>
                    <li><strong>Peminjaman:</strong> Peminjam dapat meminjam buku sesuai jadwal dan ketentuan dengan cara langsung mengambil di pespustakaan melalui resepsionis.</li>
                    <li><strong>Pengembalian:</strong> Sistem akan mendeteksi buku yang belum dikembalikan dan
                        menandainya sebagai “terlambat”.</li>
                </ul>
            </div>
        </div>

        {{-- Jadwal Operasional --}}
        <div class="card mt-4">
            <div class="card-header bg-success text-white">Jadwal Operasional Perpustakaan</div>
            <div class="card-body">
                <ul class="mb-0">
                    <li>Senin – Jumat: 08.00 – 16.00 WIB</li>
                    <li>Sabtu: 09.00 – 13.00 WIB</li>
                    <li>Minggu & Libur Nasional: <strong>Tutup</strong></li>
                </ul>
            </div>
        </div>

        {{-- Berita & Pengumuman --}}
        <div class="card mt-4">
            <div class="card-header bg-warning text-dark">Pengumuman</div>
            <div class="card-body">
                <ul>
                    <li><strong>[24 Juni 2025]</strong> Perpustakaan akan tutup lebih awal pukul 12.00 karena kegiatan
                        internal.</li>
                    <li><strong>[01 Juli 2025]</strong> Akan diadakan lomba literasi untuk siswa kelas 5 dan 6 – segera
                        daftar!</li>
                    <li><strong>[Bulan Ini]</strong> Buku baru bertema sains anak telah tersedia di rak koleksi terbaru.
                    </li>
                </ul>
            </div>
        </div>

        {{-- Kontak & Bantuan --}}
        <div class="card mt-4 mb-4">
            <div class="card-header bg-dark text-white">Kontak & Bantuan</div>
            <div class="card-body">
                <p>Untuk bantuan teknis atau pertanyaan, silakan hubungi:</p>
                <ul class="mb-0">
                    <li>Email: <a href="mailto:perpustakaan@montessori.sch.id">perpustakaan@montessori.sch.id</a></li>
                    <li>Telepon: 021-12345678</li>
                    <li>WhatsApp Admin: <a href="https://wa.me/6281234567890" target="_blank">0812-3456-7890</a></li>
                </ul>
            </div>
        </div>

        {{-- Waktu Real-time --}}
        <div class="text-right text-muted mt-3">
            <small>Waktu saat ini: <span id="timeNow">{{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</span></small>
        </div>
    </div>

    {{-- Optional: Live clock update --}}
    <script>
        setInterval(function() {
            const now = new Date();
            document.getElementById('timeNow').innerText = now.toLocaleString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
        }, 60000); // Update tiap 60 detik
    </script>

</div>
