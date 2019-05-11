(function(h){var d=h.each;var i=function(e,t){this.init(e,t)};h.extend(i.prototype,{init:function(e,t){this.options=e;this.chartOptions=t;this.columns=e.columns||this.rowsToColumns(e.rows)||[];if(this.columns.length){this.dataFound()}else{this.parseCSV();this.parseTable();this.parseGoogleSpreadsheet()}},getColumnDistribution:function(){var e=this.chartOptions,t=function(e){return(h.seriesTypes[e||"line"].prototype.pointArrayMap||[0]).length},i=e&&e.chart&&e.chart.type,n=[];d(e&&e.series||[],function(e){n.push(t(e.type||i))});this.valueCount={global:t(i),individual:n}},dataFound:function(){this.parseTypes();this.findHeaderRow();this.parsed();this.complete()},parseCSV:function(){var r=this,a=this.options,e=a.csv,l=this.columns,u=a.startRow||0,h=a.endRow||Number.MAX_VALUE,f=a.startColumn||0,c=a.endColumn||Number.MAX_VALUE,t,p=0;if(e){t=e.replace(/\r\n/g,"\n").replace(/\r/g,"\n").split(a.lineDelimiter||"\n");d(t,function(e,t){var i=r.trim(e),n=i.indexOf("#")===0,s=i==="",o;if(t>=u&&t<=h&&!n&&!s){o=e.split(a.itemDelimiter||",");d(o,function(e,t){if(t>=f&&t<=c){if(!l[t-f]){l[t-f]=[]}l[t-f][p]=e}});p+=1}});this.dataFound()}},parseTable:function(){var e=this.options,t=e.table,i=this.columns,n=e.startRow||0,s=e.endRow||Number.MAX_VALUE,o=e.startColumn||0,r=e.endColumn||Number.MAX_VALUE,a;if(t){if(typeof t==="string"){t=document.getElementById(t)}d(t.getElementsByTagName("tr"),function(e,t){a=0;if(t>=n&&t<=s){d(e.childNodes,function(e){if((e.tagName==="TD"||e.tagName==="TH")&&a>=o&&a<=r){if(!i[a]){i[a]=[]}i[a][t-n]=e.innerHTML;a+=1}})}});this.dataFound()}},parseGoogleSpreadsheet:function(){var a=this,e=this.options,t=e.googleSpreadsheetKey,l=this.columns,u=e.startRow||0,h=e.endRow||Number.MAX_VALUE,f=e.startColumn||0,c=e.endColumn||Number.MAX_VALUE,p,d;if(t){jQuery.getJSON("https://spreadsheets.google.com/feeds/cells/"+t+"/"+(e.googleSpreadsheetWorksheet||"od6")+"/public/values?alt=json-in-script&callback=?",function(e){var t=e.feed.entry,i,n=t.length,s=0,o=0,r;for(r=0;r<n;r++){i=t[r];s=Math.max(s,i.gs$cell.col);o=Math.max(o,i.gs$cell.row)}for(r=0;r<s;r++){if(r>=f&&r<=c){l[r-f]=[];l[r-f].length=Math.min(o,h-u)}}for(r=0;r<n;r++){i=t[r];p=i.gs$cell.row-1;d=i.gs$cell.col-1;if(d>=f&&d<=c&&p>=u&&p<=h){l[d-f][p-u]=i.content.$t}}a.dataFound()})}},findHeaderRow:function(){var t=0;d(this.columns,function(e){if(typeof e[0]!=="string"){t=null}});this.headerRow=0},trim:function(e){return typeof e==="string"?e.replace(/^\s+|\s+$/g,""):e},parseTypes:function(){var e=this.columns,t=e.length,i,n,s,o,r;while(t--){i=e[t].length;while(i--){n=e[t][i];s=parseFloat(n);o=this.trim(n);if(o==s){e[t][i]=s;if(s>365*24*3600*1e3){e[t].isDatetime=true}else{e[t].isNumeric=true}}else{r=this.parseDate(n);if(t===0&&typeof r==="number"&&!isNaN(r)){e[t][i]=r;e[t].isDatetime=true}else{e[t][i]=o===""?null:o}}}}},dateFormats:{"YYYY-mm-dd":{regex:"^([0-9]{4})-([0-9]{2})-([0-9]{2})$",parser:function(e){return Date.UTC(+e[1],e[2]-1,+e[3])}}},parseDate:function(e){var t=this.options.parseDate,i,n,s,o;if(t){i=t(e)}if(typeof e==="string"){for(n in this.dateFormats){s=this.dateFormats[n];o=e.match(s.regex);if(o){i=s.parser(o)}}}return i},rowsToColumns:function(e){var t,i,n,s,o;if(e){o=[];i=e.length;for(t=0;t<i;t++){s=e[t].length;for(n=0;n<s;n++){if(!o[n]){o[n]=[]}o[n][t]=e[t][n]}}}return o},parsed:function(){if(this.options.parsed){this.options.parsed.call(this,this.columns)}},complete:function(){var e=this.columns,t,i,n=this.options,s,o,r,a,l,u;if(n.complete){this.getColumnDistribution();if(e.length>1){t=e.shift();if(this.headerRow===0){t.shift()}if(t.isDatetime){i="datetime"}else if(!t.isNumeric){i="category"}}for(a=0;a<e.length;a++){if(this.headerRow===0){e[a].name=e[a].shift()}}o=[];for(a=0,u=0;a<e.length;u++){s=h.pick(this.valueCount.individual[u],this.valueCount.global);r=[];for(l=0;l<e[a].length;l++){r[l]=[t[l],e[a][l]!==undefined?e[a][l]:null];if(s>1){r[l].push(e[a+1][l]!==undefined?e[a+1][l]:null)}if(s>2){r[l].push(e[a+2][l]!==undefined?e[a+2][l]:null)}if(s>3){r[l].push(e[a+3][l]!==undefined?e[a+3][l]:null)}if(s>4){r[l].push(e[a+4][l]!==undefined?e[a+4][l]:null)}}o[u]={name:e[a].name,data:r};a+=s}n.complete({xAxis:{type:i},series:o})}}});h.Data=i;h.data=function(e,t){return new i(e,t)};h.wrap(h.Chart.prototype,"init",function(e,n,t){var s=this;if(n&&n.data){h.data(h.extend(n.data,{complete:function(i){if(n.series){d(n.series,function(e,t){n.series[t]=h.merge(e,i.series[t])})}n=h.merge(i,n);e.call(s,n,t)}}),n)}else{e.call(s,n,t)}})})(Highcharts);