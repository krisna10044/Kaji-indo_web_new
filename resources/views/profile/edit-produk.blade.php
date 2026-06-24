<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Produk – KAJI Indonesia</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Cormorant+Garamond:wght@700&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #f8f4ef;
    --surface: #ffffff;
    --border: #e8e0d6;
    --accent: #2d6a4f;
    --text: #1a1a2e;
    --text-muted: #7a7065;
    --radius: 16px;
  }
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); padding: 40px 20px; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
  
  .container { width: 100%; max-width: 650px; background: var(--surface); padding: 35px; border-radius: var(--radius); border: 1px solid var(--border); box-shadow: 0 2px 16px rgba(45,106,79,.04); }
  .title { font-family: 'Cormorant Garamond', serif; font-size: 28px; font-weight: 700; margin-bottom: 25px; color: var(--text); border-bottom: 2px solid var(--bg); padding-bottom: 10px; }
  
  .form-group { margin-bottom: 20px; }
  .form-label { display: block; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
  .form-input, .form-textarea, .form-select { width: 100%; padding: 12px 15px; background: #faf8f5; border: 1.5px solid var(--border); border-radius: 10px; color: var(--text); font-family: inherit; font-size: 14px; transition: all .2s; }
  .form-input:focus, .form-textarea:focus, .form-select:focus { outline: none; border-color: var(--accent); background: #fff; }
  .form-textarea { min-height: 120px; resize: vertical; }
  
  .preview-box { display: flex; align-items: center; gap: 15px; margin-top: 12px; background: #faf8f5; padding: 12px; border-radius: 10px; border: 1px dashed var(--border); }
  .preview-img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border); }
  .preview-text { font-size: 12px; color: var(--text-muted); display: flex; flex-direction: column; gap: 2px; }
  .preview-text strong { color: var(--text); }

  .btn-box { display: flex; justify-content: flex-end; gap: 12px; margin-top: 30px; }
  .btn { padding: 11px 22px; border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; border: none; font-family: inherit; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: all .2s; }
  .btn-primary { background: var(--accent); color: #fff; }
  .btn-primary:hover { background: #1f4e37; transform: translateY(-1px); }
  .btn-ghost { background: #f2ede7; color: var(--text); border: 1px solid var(--border); }
  .btn-ghost:hover { background: var(--border); }

  .error-msg { color: #e76f51; font-size: 12px; margin-top: 5px; font-weight: 500; }
</style>
</head>
<body>

<div class="container">
  <div class="title">Edit Produk Usaha</div>

  <form action="{{ route('dashboard.produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Nama Produk --}}
    <div class="form-group">
      <label class="form-label">Nama Produk</label>
      <input type="text" name="nama" class="form-input" value="{{ old('nama', $product->nama) }}" required placeholder="Contoh: Grosir Daster Sidoarjo">
      @error('nama') <p class="error-msg">{{ $message }}</p> @enderror
    </div>

    {{-- Kategori --}}
    <div class="form-group">
      <label class="form-label">Kategori</label>
      <select name="kategori" class="form-select" required>
        <option value="Fashion" {{ old('kategori', $product->kategori) == 'Fashion' ? 'selected' : '' }}>Fashion</option>
        <option value="Kuliner" {{ old('kategori', $product->kategori) == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
        <option value="Agrobisnis" {{ old('kategori', $product->kategori) == 'Agrobisnis' ? 'selected' : '' }}>Agrobisnis</option>
        <option value="Kerajinan" {{ old('kategori', $product->kategori) == 'Kerajinan' ? 'selected' : '' }}>Kerajinan / Jasa</option>
      </select>
      @error('kategori') <p class="error-msg">{{ $message }}</p> @enderror
    </div>


    {{-- Deskripsi --}}
    <div class="form-group">
      <label class="form-label">Deskripsi / Keterangan Produk</label>
      <textarea name="deskripsi" class="form-textarea" required placeholder="Tuliskan detail produk unggulan Anda...">{{ old('deskripsi', $product->deskripsi) }}</textarea>
      @error('deskripsi') <p class="error-msg">{{ $message }}</p> @enderror
    </div>

    {{-- Upload Gambar --}}
    <div class="form-group">
      <label class="form-label">Ganti Foto Produk</label>
      <input type="file" name="foto_produk" class="form-input" accept="image/*">
      <p style="font-size: 11px; color: var(--text-muted); margin-top: 4px;">*Biarkan kosong jika tidak ingin mengganti foto produk.</p>
      
      {{-- Box Preview Foto Saat Ini --}}
      @if($product->foto_produk)
        <div class="preview-box">
          <img src="{{ asset('storage/' . $product->foto_produk) }}" class="preview-img" alt="Foto Saat Ini">
          <div class="preview-text">
            <strong>Foto Saat Ini Aktif</strong>
            <span>Terpajang di platform KAJI Indonesia</span>
          </div>
        </div>
      @endif
      @error('foto_produk') <p class="error-msg">{{ $message }}</p> @enderror
    </div>

    {{-- Tombol Aksi --}}
    <div class="btn-box">
      <a href="{{ route('dashboard-umkm') }}" class="btn btn-ghost">Batal</a>
      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
  </form>
</div>

</body>
</html>