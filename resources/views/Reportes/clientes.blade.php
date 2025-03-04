<!DOCTYPE html>
<html>
<head>
	<title>Reporte de clientes</title>
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!-- <link rel="stylesheet" href="sass/main.css" media="screen" charset="utf-8"/> -->
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="content-type" content="text-html; charset=utf-8">
	<style type="text/css">
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font: inherit;
  font-size: 100%;
  vertical-align: baseline;
}

html {
  line-height: 1;
}

ol, ul {
  list-style: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

caption, th, td {
  text-align: left;
  font-weight: normal;
  vertical-align: middle;
}

q, blockquote {
  quotes: none;
}
q:before, q:after, blockquote:before, blockquote:after {
  content: "";
  content: none;
}

a img {
  border: none;
}

article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
  display: block;
}

body {
  font-family: 'Source Sans Pro', sans-serif;
  font-weight: 300;
  font-size: 12px;
  margin: 0;
  padding: 0;
  color: #555555;
}
body a {
  text-decoration: none;
  color: inherit;
}
body a:hover {
  color: inherit;
  opacity: 0.7;
}
body .container {
  min-width: 460px;
  margin: 0 auto;
  padding: 0 20px;
}
body .clearfix:after {
  content: "";
  display: table;
  clear: both;
}
body .left {
  float: left;
}
body .right {
  float: right;
}
body .helper {
  display: inline-block;
  height: 100%;
  vertical-align: middle;
}
body .no-break {
  page-break-inside: avoid;
}

header {
  margin-top: 15px;
  margin-bottom: 45px;
}
header figure {
  float: left;
  margin-right: 10px;
  width: 65px;
  height: 70px;
  background-color: #66BDA9;
  text-align: center;
}
header figure img {
  margin-top: 10px;
}
header .company-info {
  float: right;
  color: #66BDA9;
  line-height: 14px;
}
header .company-info .address, header .company-info .phone, header .company-info .email {
  position: relative;
}
header .company-info .address img, header .company-info .phone img {
  margin-top: 2px;
}
header .company-info .email img {
  margin-top: 3px;
}
header .company-info .title {
  color: #66BDA9;
  font-weight: 400;
  font-size: 1.33333333333333em;
}
header .company-info .icon {
  position: absolute;
  left: -15px;
  top: 1px;
  width: 10px;
  height: 10px;
  background-color: #66BDA9;
  text-align: center;
  line-height: 0;
}

section .details {
  min-width: 440px;
  margin-bottom: 40px;
  padding: 5px 10px;
  background-color: #CC5A6A;
  color: #ffffff;
  line-height: 20px;
}
section .details .client {
  width: 50%;
}
section .details .client .name {
  font-size: 1.16666666666667em;
  font-weight: 600;
}
section .details .data {
  width: 50%;
  font-weight: 600;
  text-align: right;
}
section .details .title {
  margin-bottom: 5px;
  font-size: 1.33333333333333em;
  text-transform: uppercase;
}
section table {
  width: 100%;
  margin-bottom: 20px;
  table-layout: fixed;
  border-collapse: collapse;
  border-spacing: 0;
}
section table .qty, section table .unit, section table .total {
  width: 15%;
}
section table .desc {
  width: 55%;
}
section table thead {
  display: table-header-group;
  vertical-align: middle;
  border-color: inherit;
}
section table thead th {
  padding: 7px 10px;
  background: #1E9FF2;
  border-right: 5px solid #FFFFFF;
  color: white;
  text-align: center;
  font-weight: 400;
  text-transform: uppercase;
}
section table thead th:last-child {
  border-right: none;
}
section table tbody tr:first-child td {
  border-top: 10px solid #ffffff;
}
section table tbody td {
  padding: 10px 10px;
  text-align: center;
  border-right: 3px solid #1E9FF2;
}
section table tbody td:last-child {
  border-right: none;
}
section table tbody td.desc {
  text-align: left;
}
section table tbody td.total {
  color: #66BDA9;
  font-weight: 600;
  text-align: right;
}
section table tbody h3 {
  margin-bottom: 5px;
  color: #66BDA9;
  font-weight: 600;
}
section table.grand-total {
  margin-bottom: 50px;
}
section table.grand-total tbody tr td {
  padding: 0px 10px 12px;
  border: none;
  background-color: #B2DDD4;
  color: #555555;
  font-weight: 300;
  text-align: right;
}
section table.grand-total tbody tr:first-child td {
  padding-top: 12px;
}
section table.grand-total tbody tr:last-child td {
  background-color: transparent;
}
section table.grand-total tbody .grand-total {
  padding: 0;
}
section table.grand-total tbody .grand-total div {
  float: right;
  padding: 11px 10px;
  background-color: #66BDA9;
  color: #ffffff;
  font-weight: 600;
}
section table.grand-total tbody .grand-total div span {
  display: inline-block;
  margin-right: 20px;
  width: 80px;
}

footer {
  margin-bottom: 15px;
  padding: 0 5px;
}
footer .thanks {
  margin-bottom: 40px;
  color: #66BDA9;
  font-size: 1.16666666666667em;
  font-weight: 600;
}
footer .notice {
  margin-bottom: 15px;
}
footer .end {
  padding-top: 5px;
  border-top: 2px solid #1E9FF2;
  text-align: center;
}

@font-face {
    font-family: SourceSansPro;
    src: url(SourceSansPro-Regular.ttf);
  }

  .clearfix:after {
    content: "";
    display: table;
    clear: both;
  }

  a {
    color: #0087C3;
    text-decoration: none;
  }

  body {
    position: relative;
    width: 21cm;
    height: 29.7cm;
    margin: 0 auto;
    color: #555555;
    background: #FFFFFF;
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-family: SourceSansPro;
  }

  header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #AAAAAA;
  }

  #logo {
    float: left;
    margin-top: 8px;
  }

  #logo img {
    height: 50px;
  }

  #company {
    float: right;
    text-align: right;
  }


  #details {
    margin-bottom: 50px;
  }

  #client {
    padding-left: 6px;
    border-left: 6px solid #0087C3;
    float: left;
  }

  #client .to {
    color: #777777;
  }

  h2.name {
    font-size: 1.4em;
    font-weight: normal;
    margin: 0;
  }

  #invoice {
    float: right;
    text-align: right;
  }

  #invoice h1 {
    color: #1E9FF2;
    font-size: 2.4em;
    line-height: 1em;
    font-weight: normal;
    margin: 0  0 10px 0;
  }

  #invoice h3 {
    color: #1E9FF2;
    font-size: 1.4em;
    line-height: 1em;
    font-weight: normal;
    margin: 0  0 10px 0;
  }

  #invoice .date {
    font-size: 1.1em;
    color: #777777;
  }



  #thanks{
    font-size: 2em;
    margin-bottom: 50px;
  }

  #notices{
    padding-left: 6px;
    border-left: 6px solid #0087C3;
  }

  #notices .notice {
    font-size: 1.2em;
  }

  footer {
    color: #777777;
    width: 100%;
    height: 30px;
    position: absolute;
    bottom: 0;
    border-top: 1px solid #AAAAAA;
    padding: 8px 0;
    text-align: center;
  }

	</style>
</head>

<body>
	<header class="clearfix">
        <div id="logo">
          <img src="images/lym_logo.png">
        </div>

      </header>

	<section>
		<div class="container">

            <div id="details" class="clearfix">
                <div id="invoice">
                  <h3>REPORTE DE CLIENTES</h3>
                  <div class="date">FECHA REPORTE: {{ date('d-m-y') }}</div>
                </div>
              </div>
			<table border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="qty">Tipo Documento</th>
						<th class="unit">Número Documento</th>
						<th class="unit">Nombre Completo</th>
                        <th class="unit">Teléfono</th>
                        <th class="unit">Dirección</th>
                        <th class="unit">Email</th>
					</tr>
				</thead>
				<tbody>
                    @foreach ($clientes as $cliente)
					<tr>
						<td class="qty">{{$cliente->tipo_documento}}</td>
						<td class="unit">{{$cliente->numero_documento}}</td>
						<td class="unit">{{$cliente->nombre_completo}}</td>
                        <td class="unit">{{$cliente->telefono}}</td>
                        <td class="unit">{{$cliente->direccion}}</td>
                        <td class="unit">{{$cliente->email}}</td>
                    </tr>
                    @endforeach
				</tbody>
			</table>
			<div class="no-break">

			</div>
		</div>
	</section>

	<footer>
            <div class="container">
			<div class="thanks"></div>
			<div class="notice">
				<div></div>
			</div>
			<div class="end"></div>
		</div>
	</footer>

</body>

</html>
