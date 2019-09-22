<html>
<style>
  p{
    font-size: 9pt;
  }

</style>
<body>
  <p>{{$student->district}} Health Services/Servicios de Salud</p>
  <h2>Report of Hearing Screening/Reporte del Examen Auditivo</h2>
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
  <p><span style="font-weight: 400;">During recent screening, concerns about your student&rsquo;s hearing were identified. Screening was carried out in accordance with the provisions of the California Education Code, Section 49452.</span>
  <br /><em><span style="font-weight: 400;">Durante la recientes evaluacions del examen auditivo, se identific&oacute; una inquietud en cuanto al sentido auditivo de su hijo/a. Las evaluaciones hechas en la escuela se llevaron a cabo de acuerdo con las provisiones del C&oacute;digo Educacional de California, Secci&oacute;n 49452.</span></em></p>
  <p>Below are the results of the school vision screening.
  <br /><em>A continuaci&oacute;n ver&aacute; los resultados de los recientes ex&aacute;menes m&eacute;dicos (realizados en la escuela)</em></p>
  <table style="width: 100%; margin-top: 25px;" border="1">
  <tbody>
  <tr>
  <td>Right Ear</td>
  <td>Frequency</td>
  <td>Left Ear</td>
  </tr>
  <tr>
  <td>{{$student->r5k}}</td>
  <td>5k Hertz</td>
  <td>{{$student->l5k}}</td>
  </tr>
  <tr>
  <td>{{$student->r1k}}</td>
  <td>1k Hertz</td>
  <td>{{$student->l1k}}</td>
  </tr>
  <tr>
  <td>{{$student->r2k}}</td>
  <td>2k Hertz</td>
  <td>{{$student->l2k}}</td>
  </tr>
  <tr>
  <td>{{$student->r4k}}</td>
  <td>4k Hertz</td>
  <td>{{$student->l4k}}</td>
  </tr>
  </tbody>
  </table>
  <p><br />Comments/<em>Comentarios</em>:&nbsp; &nbsp; <strong>{{$student->notes}}</strong></p>
  <p><strong>We strongly urge you to take your student to the medical provider of your choice for appropriate action.&nbsp;</strong>Have your examiner complete the bottom portion of this form and return the entire form to the school.
  <br /><strong><em>Le recomendamos que lleve a su hijo/a con el proveedor m&eacute;dico de su elecci&oacute;n para una acci&oacute;n apropiada.&nbsp;</em></strong><em><span style="font-weight: 400;">P&iacute;dale a su proveedor m&eacute;dico que llene la parte inferior de esta forma, despu&eacute;s regrese </span></em><strong><em>la forma completa </em></strong><em><span style="font-weight: 400;">a la escuela.</span></em></p>
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
  <td style="text-align:center ; font-size: 8pt;">DOB/Fecha de Nacimiento</td>
  <td style="text-align:center ; font-size: 8pt;">School/Escuela</td>
  <td style="text-align:center ; font-size: 8pt;">Grade/Grado</td>
  </tr>
  </tbody>
  </table>
  <p>Diagnosis:______________________________________________________</p>
  <p><strong>RECOMMENDATIONS:&nbsp;&nbsp;</strong></p>
  <p>____Temporary Problem(no recommendations) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ____Preferential Seating&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ____Hearing aid(s) indicated</p>

  <p><span style="font-weight: 400;">Other treatments or interventions:_______________________________________________</span></p>
  <p>Examiner's Name:________________________________________________ Phone:_______________________________</p>
  <p>Examiner's Address:_______________________________________________</p>
  <p>Date:_____________________________</p>
  </body>
  </html>
