function getCounty(county) {

	switch(county) {
	case "bake": val = "Baker"; break;
	case "bent": val = "Benton"; break;
	case "clac": val = "Clackamas"; break;
	case "clat": val = "Clatsop"; break;
	case "colu": val = "Columbia"; break;
	case "coos": val = "Coos"; break;
	case "croo": val = "Crook"; break;
	case "curr": val = "Curry"; break;
	case "desc": val = "Deschutes"; break;
	case "doug": val = "Douglas"; break;
	case "gill": val = "Gilliam"; break;
	case "gran": val = "Grant"; break;
	case "harn": val = "Harney"; break;
	case "hood": val = "Hood river"; break;
	case "jack": val = "Jackson"; break;
	case "jeff": val = "Jefferson"; break;
	case "jose": val = "Josephine"; break;
	case "klam": val = "Klamath"; break;
	case "lake": val = "Lake"; break;
	case "lane": val = "Lane"; break;
	case "linc": val = "Lincoln"; break;
	case "linn": val = "Linn"; break;
	case "malh": val = "Malheur"; break;
	case "mari": val = "Marion"; break;
	case "morr": val = "Morrow"; break;
	case "mult": val = "Multnomah"; break;
	case "polk": val = "Polk"; break;
	case "sher": val = "Sherman"; break;
	case "till": val = "Tillamook"; break;
	case "umat": val = "Umatilla"; break;
	case "unio": val = "Union"; break;
	case "wall": val = "Wallowa"; break;
	case "wasc": val = "Wasco"; break;
	case "wash": val = "Washington"; break;
	case "whee": val = "Wheeler"; break;
	case "yamh": val = "Yamhill"; break;
	}

	return val;
}

function getLogType(type) {
    switch(type) {
	case "W": val = "Water Well"; break;
	case "M": val = "Monitoring Well"; break;
	case "G": val = "Geotechnical Hole"; break;
    }
	return val;
}

function getWork(d){
	// get work
    var work = "Other";
    if(d.work_new == 1) {
    	work = "New";
	}
    if(d.work_abandonment == 1) {
        work = "Abandonment";
	}
    if(d.work_deepening == 1) {
    	work = "Alteration";
    }
	if(d.work_conversion == 1) {
	    work = "Conversion";
	}
	
	return work;
}

function getUse(d) {
	 // get use
    var use = "";
    if(d.use_domestic == 1) {
        use = "Domestic";
    }
    if(d.use_irrigation == 1) {
        use = "Irrigation";
	}
	if(d.use_community == 1) {
	    use = "Community";
	}
    if(d.use_livestock == 1) {
        use = "Livestock";
    }
    if(d.use_industrial == 1) {
        use = "Industrial";
    }
    if(d.use_injection == 1) {
        use = "Injection";
    }
    if(d.use_thermal == 1) {
        use = "Geo Thermal";
    }
    if(d.use_dewatering == 1) {
        use = "De-Watering";
    }
    if(d.use_piezometer == 1) {
        use = "Piezometer";
    }
    if(d.use_other == 1) {
        use = "Other";
    }
    
    return use;
}