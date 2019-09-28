<html>
<style>
  p{
    font-size: 9pt;
  }
</style>
<body>





<p>{{$student->district}} Health Services/Servicios de Salud</p>
<h3>Report of Vision Screening/Reporte del Examen de la Vista</h3>
<table style="width: 100%; table-layout: fixed;">
<tbody>
<tr>
<td style="text-align: center;">{{$student->fname." ".$student->lname}}</td>
<td style="text-align: center;">{{Carbon\Carbon::parse($student->dob)->format('m-d-Y ')}}</td>
<td style="text-align: center;">{{$student->school}}</td>
<td style="text-align: center;">{{$student->grade}}</td>
</tr>
<tr>
<td style="text-align: center; font-size: 8pt;">Name/Nombre</td>
<td style="text-align: center; font-size: 8pt;">DOB/Fecha de Nacimiento</td>
<td style="text-align: center; font-size: 8pt;">School/Escuela</td>
<td style="text-align: center; font-size: 8pt;">Grade/Grado</td>
</tr>
</tbody>
</table>
<p>Dear Parent/Guardian / Estimado Padre/Guardian:</p>
<p>During recent screenings, concerns about your student's vision were identified. Screenings were carried out in accordance with the provisions of the California Education Code, Section 49452.
<br /><span style="font-weight: 400;"><small>Durante las recientes evaluaciones de visi&otilde;n, se identific&oacute; una inquietud en cuanto al sentido de la vista de su hijo/a. Las evaluaciones hechas en la escuela se llevaron a cabo de acuerdo con las provisiones del C&oacute;digo Educacional de California, Secci&oacute;n 49452.</small></span></p>
<p></p>
<p><span style="font-weight: 400;">Below are the results of the school vision screening done on </span><span style="font-weight: 400;"><b>{{$student->last_edited}}</b></span>
<br><span style="font-weight: 400;"><small>A continuaci&oacute;n ver&aacute; los resultados de los recientes ex&aacute;menes m&eacute;dicos (realizados en la escuela) </small></span><b>.</b></p>
<p><b>___&nbsp;</b><span style="font-weight: 400;">With corrective lenses/</span><span style="font-weight: 400;">Con lentes correctivos&nbsp; &nbsp; &nbsp; &nbsp;____&nbsp;</span><span style="font-weight: 400;">Without corrective lenses/</span><span style="font-weight: 400;">Sin lentes correctivos</span></p>
<p></p>
<table style="width: 838px;" height="152">
<tbody>
<tr style="height: 64px;">
<td style="height: 64px; width: 309px;">
<p><span style="font-weight: 400;">Visual Acuity/</span><span style="font-weight: 400;">Agudeza Visual </span><span style="font-weight: 400;">(far/</span><span style="font-weight: 400;">distancia</span><span style="font-weight: 400;">)</span><span style="font-weight: 400;">:</span></p>
</td>
<td style="height: 64px; width: 109px;">
<p><span style="font-weight: 400;">Right/</span><span style="font-weight: 400;">Derecho:</span></p>
</td>
<td style="height: 64px; width: 149px;">
<p><b>&nbsp; &nbsp;{{$student->od_dist}}</b></p>
</td>
<td style="height: 64px; width: 113px;">
<p><span style="font-weight: 400;">Left/</span><span style="font-weight: 400;">Izquierdo:&nbsp;&nbsp;</span></p>
</td>
<td style="height: 64px; width: 128px;">
<p><strong>{{$student->os_dist}}</strong></p>
</td>
</tr>
<tr style="height: 4.75px;">
<td style="height: 4.75px; width: 309px;">
<p><span style="font-weight: 400;">Visual Acuity/</span><span style="font-weight: 400;">Aqudeza Visual </span><span style="font-weight: 400;">(</span><span style="font-weight: 400;">near</span><span style="font-weight: 400;">/cerca):</span></p>
</td>
<td style="height: 4.75px; width: 109px;">
<p></p>
</td>
<td style="height: 4.75px; width: 149px;">Both/<em>Ambos</em></td>
<td style="height: 4.75px; width: 113px;"><strong>{{$student->ou_near}}</strong></td>
<td style="height: 4.75px; width: 128px;">
<p><span style="font-weight: 400;"></span></p>
</td>
</tr>
</tbody>
</table>
<p></p>
<p>Comments/<span>Comentarios</span>:&nbsp; &nbsp; <b>{{$student->notes}}</b><br /><b>We strongly urge you to take your student to the eye care specialist of your choice for appropriate action. </b><span style="font-weight: 400;">Have your examiner complete the bottom portion of this form and return </span><b>the entire form </b><span style="font-weight: 400;">to the school. </span><br /><b><small>Le recomendamos que lleve a su hijo/a con el proveedor m&eacute;dico de los ojos de su elecci&oacute;n para una acci&oacute;n apropiada. </b><span style="font-weight: 400;">P&iacute;dale a su proveedor m&eacute;dico que llene la parte inferior de esta forma, despu&eacute;s regrese </span><b>la forma completa </b><span style="font-weight: 400;">a la escuela.</small></span></p>
<table style="width: 100%; table-layout: fixed;">
<tbody>
<tr>
<td style="text-align: center;">Pacific Audiologics</td>
<td style="text-align: center;">1846 Woodlawn Street</td>
<td style="text-align: center;">{{now()->format('m-d-Y')}}</td>
</tr>
<tr>
<td style="text-align: center; font-size: 8pt;">School Nurse/ Enfermera de la Escuela</td>
<td style="text-align: center; font-size: 8pt;">Address/Domicilio</td>
<td style="text-align: center; font-size: 8pt;">Date/Fecha</td>
</tr>
</tbody>
</table>
<hr />
<h3>Examiners Report to the School</h3>
<table style="width: 100%; table-layout: fixed;">
<tbody>
<tr>
<td style="text-align: center;">{{$student->fname." ".$student->lname}}</td>
<td style="text-align: center;">{{Carbon\Carbon::parse($student->dob)->format('m-d-Y ')}}</td>
<td style="text-align: center;">{{$student->school}}</td>
<td style="text-align: center;">{{$student->grade}}</td>
</tr>
<tr>
<td style="text-align: center; font-size: 8pt;">Name/Nombre</td>
<td style="text-align: center; font-size: 8pt;">DOB/Fecha de Nacimiento</td>
<td style="text-align: center; font-size: 8pt;">School/Escuela</td>
<td style="text-align: center; font-size: 8pt;">Grade/Grado</td>
</tr>
</tbody>
</table>
<p>Visual Acuity: &nbsp; Without correction: R________&nbsp; L________&nbsp; &nbsp;Both__________&nbsp;&nbsp;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;With correction:&nbsp; &nbsp; &nbsp;R_________ L________&nbsp; &nbsp;Both _________</p>
<p>Diagnosis:______________________________________________________</p>
<p><strong>RECOMMENDATIONS:</strong><span style="font-weight: 400;">____ Glasses or ____contact lenses prescribed</span></p>
<p><span style="font-weight: 400;">Glasses to be worn: ____All the time ____Close work only ____Distance only</span></p>
<p><span style="font-weight: 400;">Preferential seating needed: ____Yes ____No</span></p>
<p><span style="font-weight: 400;">Other treatments or interventions:_______________________________________________</span></p>
<p>Examiner's Name:________________________________________________ Phone:_______________________________</p>
<p>Examiner's Address:_______________________________________________</p>
<p>Date:_____________________________</p>


</body>
</html>
