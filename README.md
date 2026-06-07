# **LAPORAN UTS PEMROGRAMAN WEB FULLSTACK**
### **PermitOnline - Sistem Pengajuan Izin Usaha & Dokumen Warga Online**
#### Identitas/Developer : Arul Jeconiah Jaya Pratama (2305101002/6B TIF)
____________________________________________________________________________________________________________________________
### **ERD Database & Relasi**
<img width="2550" height="1100" alt="UTS Pemrograman Web 2" src="https://github.com/user-attachments/assets/46037e1a-9151-4a1b-95ab-3b493e3510be" />
Berdasarkan Foreign Key (FK) yang dirancang pada database, berikut adalah relasi antar tabelnya :

- Users ke Pemohon (One-to-Many) Satu user dapat memiliki satu atau lebih data pemohon yang terdaftar dalam sistem. Foreign key user_id berada pada tabel pemohon.
- Users ke Jenis Izin (One-to-Many) Satu user (admin) dapat membuat atau mengelola banyak jenis izin. Foreign key user_id berada pada tabel jenis_izin.
- Pemohon ke Pengajuan (One-to-Many) Satu pemohon dapat membuat banyak pengajuan izin. Foreign key pemohon_id berada pada tabel pengajuan.
- Jenis Izin ke Pengajuan (One-to-Many) Satu jenis izin dapat digunakan dalam banyak pengajuan. Foreign key jenis_izin_id berada pada tabel pengajuan.
- Pengajuan ke Dokumen (One-to-Many) Satu pengajuan dapat memiliki banyak dokumen pendukung yang diunggah. Foreign key pengajuan_id berada pada tabel dokumen.
______________________________________________________________________________________________________________________________
### **Daftar Endpoint API**
| Modul | Method | Endpoint (Route) | Deskripsi & Akses |
| :--- | :--- | :--- | :--- |
| **Auth** | POST  | /api/register | Mendaftarkan user baru |
|      | POST  | /api/login    | Login admin/pemohon untuk mendapatkan token |
|      | POST  | /api/logout   | Logout dan menghapus token |
| **Pemohon** | POST | /api/pemohon | Menambahkan pemohon |
| **Jenis Izin** | POST | /api/jenis_izin | Menambahkan jenis izin |
| **Pengajuan** | POST | /api/pengajuan | Menambahkan pengajuan |
|      | POST | /api/pengajuan/1/upload-dokumen | Menambahkan dokumen pengajuan |
|      | GET  | /api/pengajuan/1 | Menampilkan data pengajuan berdasarkan id |
|      | PUT  | /api/pengajuan/1/status | Update data pengajuan (hanya Admin) |
|      | DELETE | /api/pengajuan/1 | Hapus data pengajuan (hanya Admin) |
|      | GET | /api/pengajuan | Menampilkan semua data pengajuan (hanya Admin) |
|      | GET | /api/pengajuan?status=Draft | Menampilkan data pengajuan berdasarkan status |
|      | GET | /api/pengajuan?search=AZWLD | Melakukan pencarian berdasarkan nomer registrasi |
|      | GET | /api/pengajuan/1/cetak-pdf  | Melakukan cetak pdf surat izin pengajuan |
|      | PUT | /api/pengajuan/1/submit | Update status pengajuan |
| **Tracking** | GET | /api/tracking/PERMIT-20260607-AZWLD | Melacak pengajuan berdasarkan nomer registrasi |

### **Testing & Dokumentasi API (Postman)**
### 1. Auth

- [POST] /api/register (Pemohon)
  
  <img width="960" height="564" alt="Api Register" src="https://github.com/user-attachments/assets/9300706a-09d8-4bae-a72e-e7e86c94f61c" />
- [POST] /api/register (Admin)
  
  <img width="960" height="564" alt="Api Register sebagai Admin" src="https://github.com/user-attachments/assets/467f4305-70bf-4acd-9b2a-7faa1765ac31" />
 - [POST] /api/login (Pemohon)

   <img width="960" height="564" alt="Api Login" src="https://github.com/user-attachments/assets/8e9eb881-1eda-450c-95ba-78502165b782" />
- [POST] /api/login (Admin)

   <img width="960" height="564" alt="Api Login sebagai Admin" src="https://github.com/user-attachments/assets/dd02ef45-b650-4efe-9439-e6f421786b45" />

### 2. Pemohon

- [POST] /api/pemohon (Menambahkan pemohon)

  <img width="960" height="564" alt="Api Pemohon" src="https://github.com/user-attachments/assets/9047a1c9-ff51-4f06-b6ff-f4dc2b7edd0d" />

### 3. Jenis Izin

- [POST] /api/jenis-izin (Menambahkan jenis izin)

  <img width="960" height="564" alt="Api Jenis Izin" src="https://github.com/user-attachments/assets/af254a21-0216-4d85-a340-f2776a15c80f" />

### 4. Pengajuan

- [POST] /api/pengajuan (Menambahkan pengajuan)

  <img width="960" height="564" alt="Api Pengajuan" src="https://github.com/user-attachments/assets/6a244f3a-ff5e-4f11-84b5-5558ac56b36d" />
- [POST] /api/pengajuan/1/upload-dokumen (Menambahkan dokumen pengajuan)

  <img width="960" height="564" alt="Api Pengajuan Upload Dokumen" src="https://github.com/user-attachments/assets/2186f3b6-299a-41bf-b5c2-08231c8333a4" />
- [GET] /api/pengajuan/1 (Menampilkan data pengajuan berdasarkan id)

  <img width="960" height="564" alt="Api Pengajuan Melihat Berdasarkan Id" src="https://github.com/user-attachments/assets/acbc877e-625f-4de7-b36f-5acf571229b5" />
- [PUT] /api/pengajuan/1/status (Update data pengajuan (hanya Admin))

  <img width="960" height="564" alt="Api Pengajuan Update Status" src="https://github.com/user-attachments/assets/116fa1a2-6256-4de3-bbd1-9347ec0410c8" />
- [DELETE] /api/pengajuan/1 (Hapus data pengajuan (hanya Admin))

  <img width="960" height="564" alt="Api Menghapus Data Pengajuan Berdasarkan Id" src="https://github.com/user-attachments/assets/f7d4af8f-656c-4859-8a2c-820052328f12" />
- [GET] /api/pengajuan (Menampilkan semua data pengajuan (hanya Admin))

  <img width="960" height="564" alt="Api Pengajuan Melihat Semua Data Pengajuan" src="https://github.com/user-attachments/assets/161178b9-2ba2-4d90-b4f9-2b30ecfdcff9" />
- [GET] /api/pengajuan?status=Draft (Menampilkan data pengajuan berdasarkan status)

  <img width="960" height="564" alt="Api Pengajuan Melihat Status Draft" src="https://github.com/user-attachments/assets/b68795f6-1e75-4f28-99ec-f84f3943b622" />
- [GET] /api/pengajuan?search=AZWLD (Melakukan pencarian berdasarkan nomer registrasi)

  <img width="960" height="564" alt="Api Pengajuan Melakukan Pencarian Berdasarkan Nomer Registrasi" src="https://github.com/user-attachments/assets/cb6bae57-c532-43a2-b413-3fdc82c7600d" />
- [GET] /api/pengajuan/1/cetak-pdf (Melakukan cetak pdf surat izin pengajuan)

<img width="960" height="564" alt="Api Cetak Pdf" src="https://github.com/user-attachments/assets/de8dff3e-debc-4452-87b2-a0e8c6e1c0fc" />
- [PUT] /api/pengajuan/1/submit (Update status pengajuan)

<img width="960" height="564" alt="Api Submit Pengajuan Status Draft" src="https://github.com/user-attachments/assets/6b1c6195-2093-40a8-87d3-c392c8d577fb" />

### 5. Tracking

- [PUT] /api/tracking/PERMIT-20260607-AZWLD (Melacak pengajuan berdasarkan nomer registrasi)

  <img width="960" height="564" alt="Api Tracking" src="https://github.com/user-attachments/assets/d4488819-8ffb-4de3-be4c-4b2442d484b4" />

___________________________________________________________________________________________________________________________
### **Kendala & Solusi**

- a
