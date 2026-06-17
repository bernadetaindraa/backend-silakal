<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Selesai Diproses</title>
</head>
<body style="margin: 0; padding: 0; background-color: #F4F6F9; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; width: 100% !important;">

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #F4F6F9; padding: 30px 10px;">
        <tr>
            <td align="center">
                
                <table role="presentation" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.02); border: 1px solid #E2E8F0;" cellspacing="0" cellpadding="0" border="0">
                    
                    <tr>
                        <td style="background-color: #1D2059; padding: 35px 40px; text-align: left;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td>
                                        <div style="font-size: 20px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px; text-transform: uppercase;">
                                            SILAKAL
                                        </div>
                                        <div style="font-size: 12px; color: #93C5FD; margin-top: 4px; font-weight: 500; letter-spacing: 0.5px;">
                                            Sistem Informasi Layanan Kalurahan Hargobinangun
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px;">
                            
                            <h2 style="margin: 0 0 12px 0; font-size: 18px; font-weight: 700; color: #1E293B;">
                                Yth. {{ $layanan->user->nama_lengkap }},
                            </h2>
                            
                            <p style="margin: 0 0 24px 0; font-size: 14px; line-height: 1.6; color: #475569;">
                                Pemberitahuan resmi dari Sistem Layanan Kalurahan menyatakan bahwa permohonan layanan yang Anda ajukan telah
                                <strong>selesai diproses dan siap diambil</strong>.
                                
                                @if($layanan->pengiriman_layanan == 'email')
                                    Dokumen surat telah kami lampirkan pada email ini.
                                @else
                                    Dokumen dapat diambil langsung di kantor kalurahan pada jam pelayanan yang berlaku.
                                @endif
                            </p>

                            <table role="presentation" width="100%" style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; margin-bottom: 24px;" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 20px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                            
                                            <tr>
                                                <td width="35%" style="padding-bottom: 12px; font-size: 13px; font-weight: 600; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px;">Nomor Surat</td>
                                                <td style="padding-bottom: 12px; font-size: 14px; font-weight: 700; color: #0F172A;">
                                                    {{ $layanan->nomor_surat }}
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td style="padding-bottom: 12px; font-size: 13px; font-weight: 600; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px;">Jenis Layanan</td>
                                                <td style="padding-bottom: 12px; font-size: 14px; font-weight: 500; color: #334155;">
                                                    {{ $layanan->jenis_layanan_label }}
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td style="font-size: 13px; font-weight: 600; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px;">Tanggal Arsip</td>
                                                <td style="font-size: 14px; font-weight: 500; color: #334155;">
                                                    {{ optional($layanan->tanggal_surat)->format('d M Y') }}
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" style="background-color: #ECFDF5; border: 1px solid #A7F3D0; border-radius: 12px; margin-bottom: 28px;" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 16px 20px; font-size: 13px; line-height: 1.5; color: #065F46; font-weight: 500;">
                                        <span style="font-weight: 700; font-size: 14px;">📎 Dokumen Lampiran:</span><br>
                                        Dokumen/Surat resmi hasil layanan Anda telah kami lampirkan secara aman pada email ini. Silakan unduh file lampiran tersebut untuk keperluan Anda.
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 4px 0; font-size: 14px; color: #475569;">
                                Atas perhatian dan kerja samanya, kami ucapkan terima kasih.
                            </p>
                            <p style="margin: 24px 0 0 0; font-size: 14px; font-weight: 700; color: #1D2059;">
                                Hormat Kami,<br>
                                <span style="font-weight: 500; color: #64748B; font-size: 13px;">Tim Pelayanan Publik SILAKAL</span>
                            </p>

                        </td>
                    </tr>

                    <tr>
                        <td style="background-color: #F8FAFC; border-top: 1px solid #E2E8F0; padding: 24px 40px; text-align: center;">
                            <p style="margin: 0; font-size: 12px; line-height: 1.5; color: #94A3B8;">
                                Ini adalah email otomatis yang dikirim oleh sistem **SILAKAL**. Mohon untuk tidak membalas email ini secara langsung.
                            </p>
                            <p style="margin: 8px 0 0 0; font-size: 11px; color: #CBD5E1;">
                                &copy; {{ date('Y') }} SILAKAL. Hak Cipta Dilindungi Undang-Undang.
                            </p>
                        </td>
                    </tr>

                </table>
                
            </td>
        </tr>
    </table>

</body>
</html>