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
<td style="text-align:center">{{$student->fname." ".$student->lname}}</td>
<td style="text-align:center">{{Carbon\Carbon::parse($student->dob)->format('m-d-Y  ')}}</td>
<td style="text-align:center">{{$student->school}}</td>
<td style="text-align:center">{{$student->grade}}</td>
</tr>
<tr>
<td style="text-align:center; font-size: 8pt;">Name/Nombre</td>
<td style="text-align:center ; font-size: 8pt;">DOB/Fecha de Nacimiento</td>
<td style="text-align:center ; font-size: 8pt;">School/Escuela</td>
<td style="text-align:center ; font-size: 8pt;">Grade/Grado</td>
</tr>
</tbody>
</table>
<p>Dear Parent/Guardian / Estimado Padre/Guardian:</p>
<p>During recent screenings, concerns about your student's vision were identified. Screenings were carried out in accordance with the provisions of the California Education Code, Section 49452.<br />
<em><small>Durante las recientes evaluaciones de visi&otilde;n, se identific&oacute; una inquietud en cuanto al sentido de la vista de su hijo/a. Las evaluaciones hechas en la escuela se llevaron a cabo de acuerdo con las provisiones del C&oacute;digo Educacional de California, Secci&oacute;n 49452.</small></em></p>
<p>Below are the results of the school vision screening done on <strong>{{Carbon\Carbon::parse($student->last_edited)->format('m-d-Y  ')}}</strong><br />
<em>A continuaci&oacute;n ver&aacute; los resultados de los recientes ex&aacute;menes m&eacute;dicos (realizados en la escuela) </em><strong><em>.</em></strong></p>
<p><em>___&nbsp;With corrective lenses/Con lentes correctivos&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;___&nbsp;Without corrective lenses/Sin lentes correctivos</em></p>
<table>
<tbody>
<tr>
<td>
Visual Acuity/<em>Agudeza Visual </em>(far/<em>distancia</em>):
</td>
<td>
Right/<em>Derecho:</em>
</td>
<td>
<strong>{{$student->od_dist}}</strong>
</td>
<td>
Left/<em>Izquierdo:</em><strong>{{$student->os_dist}}&nbsp;</strong>
</td>
</tr>
<tr>
<td>
Visual Acuity/<em>Aqudeza Visual </em><em>(</em><em>near</em><em>/cerca):</em>
</td>
<td>
Both/<em>Ambos:</em>
</td>
<td><strong>{{$student->ou_near}}</strong></td>

</tr>
</tbody>
</table>
<p>Comments/<em>Comentarios</em>:&nbsp; &nbsp; <strong>{{$student->notes}}</strong></p>
<p><strong>We strongly urge you to take your student to the eye care specialist of your choice for appropriate action.&nbsp;</strong>Have your examiner complete the bottom portion of this form and return the entire form to the school.
</br><small><strong><em>Le recomendamos que lleve a su hijo/a con el proveedor m&eacute;dico de los ojos de su elecci&oacute;n para una acci&oacute;n apropiada. </em></strong><em>P&iacute;dale a su proveedor m&eacute;dico que llene la parte inferior de esta forma, despu&eacute;s regrese </em><strong><em>la forma completa </em></strong><em>a la escuela.</small></em></p>

<table style="width: 100%; table-layout: fixed;">
<tbody>
<tr>
<td style="text-align:center">Pacific Audiologics</td>
<td style="text-align:center">1846 Woodlawn Street</td>
<td style="text-align:center">{{now()->format('m-d-Y')}}</td>
</tr>
<tr>
<td style="text-align:center; font-size: 8pt;">School Nurse/ Enfermera de la Escuela</td>
<td style="text-align:center; font-size: 8pt;">Address/Domicilio</td>
<td style="text-align:center; font-size: 8pt;">Date/Fecha</td>
</tr>
</tbody>
</table>
<hr />
<h3>Examiners Report to the School</h3>
<table style="width: 100%; table-layout: fixed;">
<tbody>
<tr>
<td style="text-align:center">{{$student->fname." ".$student->lname}}</td>
<td style="text-align:center">{{Carbon\Carbon::parse($student->dob)->format('m-d-Y  ')}}</td>
<td style="text-align:center">{{$student->school}}</td>
<td style="text-align:center">{{$student->grade}}</td>
</tr>
<tr>
<td style="text-align:center; font-size: 8pt;">Name/Nombre</td>
<td style="text-align:center; font-size: 8pt;">DOB/Fecha de Nacimiento</td>
<td style="text-align:center; font-size: 8pt;">School/Escuela</td>
<td style="text-align:center; font-size: 8pt;">Grade/Grado</td>
</tr>
</tbody>
</table>
<p>Visual Acuity: &nbsp; Without correction: R________&nbsp; L________&nbsp; &nbsp;Both__________&nbsp;&nbsp;</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;With correction:&nbsp; &nbsp; &nbsp;R_________ L________&nbsp; &nbsp;Both _________</p>
<p>Diagnosis:______________________________________________________</p>
<p><strong>RECOMMENDATIONS:</strong><span style="font-weight: 400;">____  Glasses or ____contact lenses prescribed</span></p>
<p><span style="font-weight: 400;">Glasses to be worn: ____All the time ____Close work only ____Distance only</span></p>
<p><span style="font-weight: 400;">Preferential seating needed: ____Yes ____No</span></p>
<p><span style="font-weight: 400;">Other treatments or interventions:_______________________________________________</span></p>
<p>Examiner's Name:________________________________________________ Phone:_______________________________</p>
<p>Examiner's Address:_______________________________________________</p>
<p>Date:_____________________________</p>
</body>
</html>
