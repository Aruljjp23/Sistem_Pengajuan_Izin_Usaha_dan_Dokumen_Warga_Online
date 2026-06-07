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
1.Auth

- [POST] /api/register (Pemohon)
  <img width="960" height="564" alt="Api Register" src="https://github.com/user-attachments/assets/9300706a-09d8-4bae-a72e-e7e86c94f61c" />
- [POST] /api/register (Admin)
  <img width="960" height="564" alt="Api Register sebagai Admin" src="https://github.com/user-attachments/assets/467f4305-70bf-4acd-9b2a-7faa1765ac31" />
