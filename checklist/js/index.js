$(function(){
	
	function createTable(b){
		let cPointOptions = localStorage.getItem("cPointOptions");
		let cPoint = [];
		if (typeof cPointOptions !== 'undefined' && cPointOptions !== null){
			 cPoint = JSON.parse(cPointOptions);
		}else{
			 cPoint = [];
		}
		let labels = ['checkCode','checkPoint','checkItems','subCheckItem'];
			var table = document.createElement('table');
			var thead = document.createElement('thead');
			var tbody = document.createElement('tbody');
			var theadTr = document.createElement('tr');
				for (var i = 0; i < labels.length; i++) {
					var theadTh = document.createElement('th');
					theadTh.innerHTML = labels[i].toUpperCase();
					theadTr.appendChild(theadTh);
				} 
				thead.appendChild(theadTr);
				table.appendChild(thead);
		$.each(cPoint,function(i,val){
			// console.log(val);
			var tbodyTr = document.createElement('tr');
			$.each(val,function(a,c){
				var tbodyTd = document.createElement('td');
				if(Array.isArray(c)){
					let tbod = [];
					$.each(c,function(d,e){
						if(typeof e ==='object'){
							let sub = []
							$.each(e, function(x,z){
								sub.push('<ul>=> <span style="text-decoration:underline;font-weight:bold">'+val["checkItems"][d]+'</span></ul>');	
								$.each(z, function(t,r){
									sub.push('<li>'+r+'</li>');	
								})
							})
							tbod.push(sub)
						}else{
							tbod.push('<li>'+val["checkCode"]+[d]+'. '+e+'</li>');	
						}
						
					})
					tbodyTd.innerHTML = tbod.join(' ');
				}else{
					tbodyTd.innerHTML = val[a];
				}
				
				tbodyTr.appendChild(tbodyTd);
			})
			tbody.appendChild(tbodyTr);
		})
		
	
		table.appendChild(tbody);
		b.appendChild(table);
		
		
	}
	// buildTable(labels1, objects1, document.getqElementById('a'));
	createTable(document.getElementById('table'));
	$(document).on('click','#cPoint',function(){
		
		let cPointOptions = localStorage.getItem("cPointOptions");
		let cPoint = [];
		if (typeof cPointOptions !== 'undefined' && cPointOptions !== null){
			 cPoint = JSON.parse(cPointOptions);
		}else{
			 cPoint = [];
		}
		
		let obj = {};
		let cPointCode = $("#cPointCode").val();
		let cPointCheck = $("#cPointCheck").val();
		if(cPointCheck.length > 0){
			obj["checkCode"] = cPointCode;
			obj["checkPoint"] = cPointCheck;
			cPoint.push(obj);	
		}
		// console.log(cPoint);
		localStorage.setItem("cPointOptions",JSON.stringify(cPoint));
		$("#table").html("");
		createTable(document.getElementById('table'));
	})
	
	$(document).on('click','#subItem',function(){
		let checkCode = $("#checkcode").val();
		let itemCode = $("#checkitem").val();
		let subItemValue = $("#subItemValue").val();
		// console.log(itemCode,subItemValue);
		let arr = [];
		let store = localStorage.getItem("cPointOptions");
		if (typeof store !== 'undefined' && store !== null){
			 arr = JSON.parse(store);
		}else{
			 arr = [];
		}
		let itemCodeValue = itemCode.split('');
		var elementPos = arr.map(function(x) {return x.checkCode; }).indexOf(itemCodeValue[0]);
		// console.log(elementPos)
		let subItems = [];
		let storeSubItems = [];
		arr.map(data=>{
			if(data.checkCode == itemCodeValue[0]){
				storeSubItems = data.subCheckItem
			}
		})
		let checkPoints = arr[elementPos];
		let newItems = [];
		if (typeof storeSubItems !== 'undefined' && storeSubItems !== null){
			 newItems = storeSubItems;
		}else{
			 newItems = [];
		}
		// console.log(typeof newItems === 'object' && newItems !== null)
		if(newItems.length > 0){
			
			//if subCheckItem is existing//
			$.each(newItems,function(i, val){
				// console.log(val.hasOwnProperty(itemCode))
				if(val.hasOwnProperty(itemCode)){
					//if itemCode is existing//
					let obj = {};
					let objValue = val[itemCode];
					objValue.push(subItemValue)
					obj[itemCode] = objValue
				}else{
					//if itemCode is not existing//
					let obj = {};
					let objValue = [];
					objValue.push(subItemValue)
					obj[itemCode] = objValue
				}
			})
			
		}else{
		//if subCheckItem did not exists//
				let obj = {};
				let objValue = [];
				objValue.push(subItemValue)
				obj[itemCode] = objValue
				newItems.push(obj)
			
		}
		
		subItems = newItems
		// console.log(newItems)
		Object.assign(checkPoints, {"subCheckItem": subItems});
		arr[elementPos] = checkPoints;
		localStorage.setItem("cPointOptions",JSON.stringify(arr));
		// console.log(JSON.stringify(arr))
		$("#table").html("");
		createTable(document.getElementById('table'));
		// $("#subItemValue").clear();
	})
	
	$(document).on('click','#item',function(){
		let data = localStorage.getItem("cPointOptions");
		let cPointData = [];
		if (typeof data !== 'undefined' && data !== null){
			 cPointData = JSON.parse(data);
		}else{
			 cPointData = [];
		}
		
		let cPoint = $("#checkcode").val();
		var elementPos = cPointData.map(function(x) {return x.checkCode; }).indexOf(cPoint);
		let item = $("#itemValue").val();
		let items = [];
		let dataItems = [];
		cPointData.map(data=>{
			let x = {};
			if(data.checkCode == cPoint){
				 dataItems = data["checkItems"]
				 // console.log(x)
			}
		})
		if (typeof dataItems !== 'undefined' && dataItems !== null){
			items = dataItems
		}else{
			items = []
		}
		let obj = [];
		obj.push(item);
		var children = items.concat(obj);
		let itemNew = []
		$.each(children, function(i,ins){
			itemNew[i] = ins;
		})
		// localStorage.setItem("sap",JSON.stringify(itemNew));
		let checkPoints = cPointData[elementPos];
		Object.assign(checkPoints, {"checkItems":itemNew});
		cPointData[elementPos] = checkPoints;
		localStorage.setItem("cPointOptions",JSON.stringify(cPointData));
		// console.log(cPointData)
		
		$("#table").html("");
		createTable(document.getElementById('table'));
		// $("#itemValue").text("");
		
	})
	
	function options(){
		let options = localStorage.getItem("cPointOptions");
		let arr = [];
		if (typeof options !== 'undefined' && options !== null){
			 arr = JSON.parse(options);
		}else{
			 arr = [];
		}
		
		let select = document.getElementById('checkcode');
		$.each(arr,function(i, ins){
			var opt = document.createElement('option');
			opt.value = arr[i].checkCode;
			opt.innerHTML = arr[i].checkCode+'.'+arr[i].checkPoint;
			select.appendChild(opt);
		})
	}
	options();
	function options2(x){
		let options = localStorage.getItem("cPointOptions");
		let arr = [];
		if (typeof options !== 'undefined' && options !== null){
			 arr = JSON.parse(options);
		}else{
			 arr = [];
		}
		
		let cItem = [];
		arr.filter(data=>{
			if(data.checkCode == x){
				cItem = data.checkItems
			}
		})
		// console.log(cItem)
		let select = document.getElementById('checkitem');
		if (typeof cItem !== 'undefined' && cItem !== null){
		$.each(cItem,function(i, ins){
			
			var opt = document.createElement('option');
			opt.value = x+i;
			opt.innerHTML = ins;
			select.appendChild(opt);
			console.log(opt)
		})
		}
	}
	
	$(document).on('change','#checkcode',function(){
		$("#checkitem").empty();
		let x = $(this).val();
		options2(x);
		// console.log(x)
	})
	
	
	
	
	
	
	
})