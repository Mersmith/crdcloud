<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Servicio::factory(1)->create();

        // Tu consulta SQL
        $sql = "INSERT INTO `servicios` (`id`, `nombre`, `precio_venta`, `puntos_ganar`, `puntos_canjeo`) VALUES
        (1, 'RX PANORAMICA S/ANALISIS', '50.00', '1.50', '50.00'),
        (2, 'RX PANORAMICA C/ANALISIS', '60.00', '1.80', '60.00'),
        (3, 'RX CEFALOMETRIA LATERAL S/ANALISIS', '50.00', '1.50', '50.00'),
        (4, 'RX CEFALOMETRIA LATERAL C/ANALISIS', '80.00', '2.40', '80.00'),
        (5, 'ORTO 1: PX + LX C/ANALISIS(INC. 2 ANALISIS + FOTOS EXTRA)', '135.00', '4.05', '135.00'),
        (6, 'ORTO 2: PX +LX C/ANALISIS + FOTOS EXTRAORALES E INTRAORALES(INC. 2 ANALISIS)', '180.00', '5.40', '180.00'),
        (7, 'ORTO 3: PX+ LX S/ANALISIS', '100.00', '3.00', '100.00'),
        (8, 'TOMOGRAFIA CAMPO MEDIO S/A SOLO CD(INCLUYE 1 RX PANOR&Aacute;MICA EN FISICO)', '100.00', '3.00', '100.00'),
        (9, 'TOMOGRAFIA 1 MAXILAR C/ANALISIS', '300.00', '9.00', '300.00'),
        (10, 'TOMOGRAFIA 2 MAXILARES C/ANALISIS', '355.00', '10.65', '355.00'),
        (11, 'TOMOGRAFIA AXIAL SENOS MAXILARES', '275.00', '8.25', '275.00'),
        (12, 'TOMOGRAFIA DE LOCALIZACION/UBICACION DE DIENTE IMPACTADO', '275.00', '8.25', '275.00'),
        (13, 'TOMOGRAFIA S/ANALISIS SOLO CD: ATM BA/BC(2 TOMAS)', '270.00', '8.10', '270.00'),
        (14, 'TOMOGRAFIA ATM C/ANALISIS + CORTES', '410.00', '12.30', '410.00'),
        (15, 'RX ATM BA/BC C/INFORME', '100.00', '3.00', '100.00'),
        (16, 'RX CARPAL S/ANALISIS', '50.00', '1.50', '50.00'),
        (17, 'RX CARPAL C/INFORME', '65.00', '1.95', '65.00'),
        (18, 'RX POSTERO ANTERIOR S/ANALISIS', '50.00', '1.50', '50.00'),
        (19, 'RX POSTERO ANTERIOR C/ANALISIS(CORTESIA FOTOS EXTRA)', '80.00', '2.40', '80.00'),
        (20, 'SET DE FOTOS INTRAORALES (5 INTRA + CORTSIA:FOTOS EXTRAS)', '50.00', '1.50', '50.00'),
        (21, 'SET DE FOTOS EXTRAORALES', '30.00', '0.90', '30.00'),
        (22, 'DUPLICADO SOLO PLACA (PANO, LX, PA O CARPAL)', '25.00', '0.75', '25.00'),
        (23, 'DUPLICADO DE PANO , ATM, SENOS(CD + PLACA + INFORME)', '40.00', '1.20', '40.00'),
        (24, 'DUPLICADO DE TOMOGRAFIA C/A (PLANTILLA + PANO + INFORME + CD)', '160.00', '4.80', '160.00'),
        (25, 'DUPLICADO ORTO C/A (CD + PLACA + INFORME + ANALISIS)', '70.00', '2.10', '70.00'),
        (26, 'DUPLICADO SOLO CD', '15.00', '0.45', '15.00'),
        (27, 'TOMOGRAFIA CAMPO AMPLIO S/A SOLO CD(INCLUYE 1 RX PANORAMICO EN FISICO)', '110.00', '3.30', '110.00'),
        (28, 'RX PANORAMICA C/INFORME (PROMOCION)', '50.00', '1.50', '50.00'),
        (29, 'ORTO 3 (PROMOCION)', '90.00', '2.70', '90.00'),
        (30, 'RX ATM + INFORME + RX PANORAMICA DE CORTESIA', '100.00', '3.00', '100.00'),
        (31, 'TOMOGRAF&amp;Iacute;A CAMPO AMPLIO + LX S/ANALISIS', '160.00', '4.80', '160.00'),
        (32, 'RX PANOR&amp;Aacute;MICA VIRTUAL S/A LINEA DE CREDITO SONRISAS BRILLANTES', '45.00', '1.35', '45.00'),
        (33, 'ORTO 3 VIRTUAL S/A LINEA DE CREDITO SONRISAS BRILLANTES', '90.00', '2.70', '90.00'),
        (34, 'PANORAMICA S/A + LX C/A', '130.00', '3.90', '130.00'),
        (35, 'RX ATM C/A + RX PANORAMICA DE CORTESIA + LX S/A', '150.00', '4.50', '150.00'),
        (36, 'ATM + INFORME + PANO +INFORME', '120.00', '3.60', '120.00'),
        (37, 'PANOR&Aacute;MICA CON INFORME PROMOCI&Oacute;N', '30.00', '0.90', '60.00'),
        (38, 'ORTO 1: PX + LX C/ANALISIS(INC. 2 ANALISIS + FOTOS EXTRA) + 1 ANALISIS', '160.00', '4.80', '160.00'),
        (39, 'TOMOGRAF&amp;Iacute;A CAMPO AMPLIO + CORTES&amp;Iacute;A 1 PANOR&amp;Aacute;MICA', '90.00', '2.70', '90.00'),
        (40, 'RX PANORAMICA VIRTUAL S/ANALISIS LINEA DE CREDITO AYNI DENT ', '40.00', '1.20', '40.00'),
        (41, 'ORTO1 : PX + LX CON 2 ANALISIS VIRTUAL + FOTOS EXTRA - LINEA DE CREDITO - SOLUCION D', '100.00', '3.00', '100.00'),
        (42, 'ORTO 3 + SET DE FOTOS INTRAORALES', '150.00', '4.50', '150.00'),
        (43, 'RX PANOR&amp;Aacute;MICA VIRTUAL S/A', '40.00', '1.20', '40.00'),
        (44, 'Lateral con analisis+Set de fotos+Duplicado pano', '155.00', '4.65', '155.00'),
        (45, 'ORTO1 : PX + LX CON 2 ANALISIS + 1 ANALIS VIRTUAL + FOTOS EXTRA - LINEA DE CREDITO - SOLUCION DENTAL', '120.00', '3.60', '120.00'),
        (46, 'TOMO + ORTO 3 (PANO Y CEFA S/A)', '210.00', '6.30', '210.00'),
        (47, 'RX PANOR&amp;Aacute;MICA C/A LINEA DE CREDITO ', '55.00', '1.65', '55.00'),
        (48, 'ORTO 3 S/A LINEA DE CREDITO ORAL HOME', '100.00', '3.00', '100.00'),
        (49, 'CEFALOM&amp;Eacute;TRICA + FRONTAL S/A', '100.00', '3.00', '100.00'),
        (50, 'TOMOGRAFIA SOLO + PANO VIRTUAL ', '90.00', '2.70', '90.00'),
        (51, 'PANORAMICA CON INFORME ( PROMOCION) ', '50.00', '1.50', '50.00'),
        (52, '', '0.00', '0.00', '0.00'),
        (53, 'TOMO CD + LATERAL S/A', '160.00', '4.80', '160.00'),
        (54, 'TOMO CAMPO MEDIOANO + PANO ', '90.00', '2.70', '90.00'),
        (55, 'RX PANORAMICA CONVENIO ANGELICA GAMARRA', '45.00', '1.35', '0.00'),
        (56, 'TOMOGRAFIA CAMPO MEDIO S/A SOLO CD(INCLUYE 1 RX PANOR&amp;Aacute;MICA EN FISICO) (PROMOCION)', '90.00', '2.70', '90.00'),
        (57, 'TOMO + CEFA C/A ', '190.00', '5.70', '190.00'),
        (58, 'REPETICI&Oacute;N TOMO CAMPO AMPLIO S&Oacute;LO CD', '0.00', '0.00', '0.00'),
        (59, 'TOMOGRAFIA CAMPO MEDIO S/A SOLO CD(INCLUYE 1 RX PANOR&Aacute;MICA EN FISICO) + RX LATERA&Ntilde;', '150.00', '4.50', '150.00'),
        (60, 'TOMO CAMPO AMPLIO Y ORTO 1 VIRTUAL LINEA DE CREDITO', '230.00', '6.90', '0.00'),
        (61, 'ORTO3 (FAMILIAR)', '50.00', '1.50', '0.00'),
        (62, 'TOMO SOLO CD (FAMILIAR)', '50.00', '1.50', '0.00'),
        (63, 'TOMOGRAFIA SOLO CD + PANO VIRTUAL (PROMOCION)', '90.00', '2.70', '0.00'),
        (64, 'REPETICION TOMOGRAFIA SOLO LINK ', '0.00', '0.00', '0.00'),
        (65, 'Tomo CD + Lateral C/A', '180.00', '5.40', '180.00'),
        (66, 'TOMO DE LOCALIZACION', '280.00', '8.40', '0.00'),
        (67, 'TOMO SOLO CD ', '100.00', '3.00', '0.00'),
        (68, 'RX PANORAMICA S/ANALISIS LINEA DE CREDITO KARISMA ANGELICA GAMARRA', '45.00', '2.25', '0.00'),
        (69, 'TOMO SOLO CD+ ORTO 2(PX+LX C/A +FOTOS EXTRAORALES E INTRAORALES,INCLUYE 2 ANALISIS)', '280.00', '14.00', '0.00');";

        // Ejecutar la consulta
        DB::statement($sql);
    }
}
