<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form</title>
  <style>
    .row {
      display: flex;
      flex-direction: row;
      align-items: center;
    }
  </style>
</head>
<body>
  <h1>Cara Membuat Form</h1>

  <form id="form">
    <table border="0">
      <tr>
        <td>
          <label for="kode">Kode</label>
        </td>
        <td>
          <input type="text" name="kode" id="kode" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="nama">Nama</label>
        </td>
        <td>
          <input type="text" name="nama" id="nama" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="jk">Jenis Kelamin</label>
        </td>
        <td>
          <div class="row">
            <div class="row">
              <input type="radio" name="jk" id="pria" value="pria" />
              <label for="pria">Pria</label>
            </div>
            <div class="row">
              <input type="radio" name="jk" id="wanita" value="wanita" />
              <label for="wanita">Wanita</label>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <label for="agama">Agama</label>
        </td>
        <td>
          <select name="agama" id="agama">
            <option value="islam">Islam</option>
            <option value="kristen">Kristen</option>
            <option value="budha">Budha</option>
            <option value="hindu">Hindu</option>
            <option value="konghuchu">Konghuchu</option>
            <option value="other">Other</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          <label for="provinsi">Provinsi</label>
        </td>
        <td>
          <select name="provinsi" id="provinsi" onchange="cariKota()">
            <option value=""></option>
            <option value="jakarta">DKI Jakarta</option>
            <option value="banten">Banten</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
          <label for="kota">Kota</label>
        </td>
        <td>
          <select name="kota" id="kota">
          </select>
        </td>
      </tr>
      <tr>
        <td>
          <label for="alamat">Alamat</label>
        </td>
        <td>
          <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>
        </td>
      </tr>
      <tr>
        <td>
          <label for="password">Password</label>
        </td>
        <td>
          <input type="password" name="password" id="password" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="hobi">Hobi</label>
        </td>
        <td>
          <div class="row">
            <div class="row">
              <input type="checkbox" name="hobi" id="renang" value="renang" />
              <label for="renang">Renang</label>
            </div>
            <div class="row">
              <input type="checkbox" name="hobi" id="browsing" value="browsing" />
              <label for="browsing">Browsing</label>
            </div>
            <div class="row">
              <input type="checkbox" name="hobi" id="dugem" value="dugem" />
              <label for="dugem">Dugem</label>
            </div>
          </div>
        </td>
      </tr>
    </table>
    <button type="submit" name="submit">Kirim</button>
  </form>

  <script>
    window.onload = function() {
      document.getElementById('form').addEventListener('submit', function(e) {
        e.preventDefault();

        submitData(e);
      })
  
      async function submitData(e) {
        const urlApi = 'api/submit-data.php';
        const formData = new FormData(e.currentTarget);

        formData.set('hobi', [].join.call([].map.call([].filter.call(document.querySelectorAll('input[name="hobi"]'), (checkbox) => checkbox.checked), (checkbox) => checkbox.value), ', '));

        if (!formData.get('nama') || !formData.get('kode') || !formData.get('password')) {
          alert('Nama, kode, password tidak boleh kosong');

          return;
        }

        const payload = {
          kode: formData.get('kode'),
          nama: formData.get('nama'),
          sex: formData.get('jk'),
          agama: formData.get('agama'),
          provinsi: formData.get('provinsi'),
          kota: formData.get('kota'),
          alamat: formData.get('alamat'),
          password: formData.get('password'),
          hobi: formData.get('hobi'),
        };

        try {
          const submitRawResponse = await fetch(urlApi, {
            method: 'POST',
            'Content-Type': 'application/json',
            body: JSON.stringify(payload)
          });
          const submitResponse = await submitRawResponse.json();

          if (submitResponse.status) {
            alert('Berhasil Simpan');
          } else {
            alert('Gagal Simpan, ' + submitResponse.message);
          }
        } catch (error) {
          alert('Gagal Simpan, karena kesalahan sistem');
        }

      }
    }

    async function cariKota() {
      const selectedProvince = document.getElementById('provinsi').value;
      const urlApi = `/api/check-city.php?province=${encodeURIComponent(selectedProvince)}`;

      const checkCityRawResponse = await fetch(urlApi);
      const checkCityResponse = await checkCityRawResponse.json(); // expected array

      document.getElementById('kota').innerHTML = checkCityResponse.map(function(city) {
        return `<option value="${city.value}">${city.name}</option>`
      }).join('\n');
    }
  </script>
</body>
</html>
