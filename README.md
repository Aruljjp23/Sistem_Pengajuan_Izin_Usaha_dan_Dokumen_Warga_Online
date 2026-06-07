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
### **ERD Database & Relasi**
| Modul | Method | Endpoint (Route) | Deskripsi & Akses |
| :--- | :---: | :---: | ---: |
| Auth | POST  | /api/register | Mendaftarkan user baru |
