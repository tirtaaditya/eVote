<?php

namespace App\Libraries;

class URLHelper
{
	public function __construct()
	{
		$moneyChangerAPIPrefixURL = "http://localhost:8000/moneychanger/Api";
		$moneyChangerFilePrefixURL = "http://localhost:8000/moneychanger-file";

		//localhost:8080/moneychanger-banknotes/Api
		// Other
		$this->prefixFile = $moneyChangerFilePrefixURL;

		$this->login = $moneyChangerAPIPrefixURL."/auth/login";
		$this->logout = $moneyChangerAPIPrefixURL."/auth/logout";
		$this->lastActivity = $moneyChangerAPIPrefixURL."/auth/update";
		$this->verifikasiSso = $moneyChangerAPIPrefixURL."/auth/verifikasiUserSSO";

		$this->notification = $moneyChangerAPIPrefixURL."/notification";
		$this->auditActivity = $moneyChangerAPIPrefixURL."/auditactivity";
		$this->auditEsb = $moneyChangerAPIPrefixURL."/auditesb";
		$this->auditInterface = $moneyChangerAPIPrefixURL."/auditinterface";
		$this->auditSystem = $moneyChangerAPIPrefixURL."/auditsystem";

		// Manajemen
		$this->workingUnit = $moneyChangerAPIPrefixURL."/manajemen/workingunit";
		$this->division = $moneyChangerAPIPrefixURL."/manajemen/division";
		$this->group = $moneyChangerAPIPrefixURL."/manajemen/group";
		$this->jobPosition = $moneyChangerAPIPrefixURL."/manajemen/jobposition";	
		$this->authority = $moneyChangerAPIPrefixURL."/manajemen/authority";
		$this->menu = $moneyChangerAPIPrefixURL."/manajemen/menu";
		$this->role = $moneyChangerAPIPrefixURL."/manajemen/role";
		$this->userParameter = $moneyChangerAPIPrefixURL."/manajemen/userparameter";
		$this->systemParameter = $moneyChangerAPIPrefixURL."/manajemen/systemparameter";
		$this->user = $moneyChangerAPIPrefixURL."/manajemen/user";

		// Kurs
		$this->kurs = $moneyChangerAPIPrefixURL."/kurs/inquiry";

		// Modal
		$this->modal = $moneyChangerAPIPrefixURL."/kurs/modal/show";

		// Range Kurs
		$this->rangeKurs = $moneyChangerAPIPrefixURL."/kurs/range";
		$this->createRangeKurs = $moneyChangerAPIPrefixURL."/kurs/range/create";
		
		// Currency
		$this->currency = $moneyChangerAPIPrefixURL."/manajemen/currency";

		// Branch
		$this->branch = $moneyChangerAPIPrefixURL."/manajemen/branch";

		//Regitrasi IA
		$this->regitrasiia = $moneyChangerAPIPrefixURL."/manajemen/registrasiia";
		$this->regitrasiiaCreate = $moneyChangerAPIPrefixURL."/manajemen/registrasiia/create";
		$this->regitrasiiaEdit = $moneyChangerAPIPrefixURL."/manajemen/registrasiia/update";
		$this->regitrasiiaDelete = $moneyChangerAPIPrefixURL."/manajemen/registrasiia/delete";

		//Geser Kas
		$this->geser = $moneyChangerAPIPrefixURL."/kas/geserkas";
		$this->lembarKas = $moneyChangerAPIPrefixURL."/kas/lembar";
		$this->lembarKasUpload = $moneyChangerAPIPrefixURL."/kas/lembar/uploadbanknotes";

		$this->createGeserKas = $moneyChangerAPIPrefixURL."/kas/geserkas/create";

		//Terima Kas
		$this->terima = $moneyChangerAPIPrefixURL."/kas/terimakas";
		$this->terimaUpload = $moneyChangerAPIPrefixURL."/kas/terimakas/uploadbanknotes";
		$this->createTerimaKas = $moneyChangerAPIPrefixURL."/kas/terimakas/create";
		$this->detailTerimaKas = $moneyChangerAPIPrefixURL."/kas/terimakas/uploadbanknotes";

		// Detail Kas
		$this->detailKas = $moneyChangerAPIPrefixURL."/kas/lembar";
		$this->detailKasUpload = $moneyChangerAPIPrefixURL."/kas/lembar/uploadbanknotes";

		// Nominal Kas
		$this->monitorKas = $moneyChangerAPIPrefixURL."/kas/nominal";

		// TK dari Brinets
		$this->createTKbrinets = $moneyChangerAPIPrefixURL."/kas/tkbrinets/create";
		
		//TellerCashOut	
		$this->cektellerCashOut = $moneyChangerAPIPrefixURL."/kas/tellercashout/cekstatus";
		$this->tellerCashOut = $moneyChangerAPIPrefixURL."/kas/tellercashout";

		// Setor Brinets
		$this->createSetorBrinets = $moneyChangerAPIPrefixURL."/kas/setorbrinets/create";

		// Open Close Branch
		$this->cekopenclose = $moneyChangerAPIPrefixURL."/manajemen/openclosebranch/detailclose";
		$this->openbranch = $moneyChangerAPIPrefixURL."/manajemen/openclosebranch/open";
		$this->closebranch = $moneyChangerAPIPrefixURL."/manajemen/openclosebranch/close";

		// Laba Rugi
		$this->totallabarugi = $moneyChangerAPIPrefixURL."/manajemen/labarugi/total";

		//Transaksi
		//SetorTarik
		$this->setorTarik = $moneyChangerAPIPrefixURL."/transaksi/nonlite/setortarik";

		//Jual Beli 
		$this->jualBeli = $moneyChangerAPIPrefixURL."/transaksi/nonlite/jualbeli";

		$this->inquiryAccount = $moneyChangerAPIPrefixURL."/account";
		$this->amount = $moneyChangerAPIPrefixURL."/amount";
		$this->selisihidr = $moneyChangerAPIPrefixURL."/kas/opnamekas/selisihidr";

		//Nego Kanpus
		$this->negoPusat = $moneyChangerAPIPrefixURL."/transaksi/nonlite/negopusat";

		//Pembatalan
		$this->pembatalan = $moneyChangerAPIPrefixURL."/transaksi/nonlite/pembatalan";

		//opname kas
		$this->opnameKas = $moneyChangerAPIPrefixURL."/kas/opnamekas";
		$this->createOpnameKas = $moneyChangerAPIPrefixURL."/kas/opnamekas/create";

		//monitor opname
		$this->monitorOpname = $moneyChangerAPIPrefixURL."/kas/monitoropname";
		
		//pending kas
		$this->pendingKas = $moneyChangerAPIPrefixURL."/kas/pendingkas";
		$this->createPendingKas = $moneyChangerAPIPrefixURL."/kas/pendingkas/create";

		//Purpose
		$this->purpose = $moneyChangerAPIPrefixURL."/purpose";
		$this->purposeCreate = $moneyChangerAPIPrefixURL."/purpose/create";
		$this->purposeEdit = $moneyChangerAPIPrefixURL."/purpose/update";

		//Undelying
		$this->underlying = $moneyChangerAPIPrefixURL."/underlying";
		$this->underlyingCreate = $moneyChangerAPIPrefixURL."/underlying/create";
		$this->underlyingEdit = $moneyChangerAPIPrefixURL."/underlying/update";

		//Nasabah
		$this->nasabah = $moneyChangerAPIPrefixURL."/manajemen/nasabah";
		$this->nasabahCreate = $moneyChangerAPIPrefixURL."/manajemen/nasabah/create";
		$this->nasabahEdit = $moneyChangerAPIPrefixURL."/manajemen/nasabah/update";
		
		//Tutup Kas
		$this->cektutupKas = $moneyChangerAPIPrefixURL."/kas/tutupkas/cekstatus";
		$this->tutupKas = $moneyChangerAPIPrefixURL."/kas/tutupkas";

		//Upload
		$this->upload = $moneyChangerAPIPrefixURL."/upload/create"; 

		//Dashboard
		$this->banknotes = $moneyChangerAPIPrefixURL."/dashboard/banknotes";
		$this->kasbanknotes = $moneyChangerAPIPrefixURL."/kas/banknotes";

		
	}
}