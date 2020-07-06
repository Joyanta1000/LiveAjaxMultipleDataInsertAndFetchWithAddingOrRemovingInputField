<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
<br/>
<div class="container">
	<br/>
	<div class="shadow-lg p-3 mb-5 bg-white rounded">

	<div style="padding-left:60px;"><span class="navbar-brand"><div class="shadow-lg p-3 mb-5 bg-white rounded">Ajax live multiple data insertion and fetching with adding or removing input fields</div></span></div>

	<br/>
	<div class="table-responsive">
		<table class="table table-bordered" id="crud_table">
			<tr>
				<th width="30%">Item Name</th>
				<th width="10%">Item Code</th>
				<th width="45%">Description</th>
				<th width="10%">Price</th>
				<th width="5%"></th>
			</tr>
			<tr>
				<td contenteditable="true" class="item_name"></td>
				<td contenteditable="true" class="item_code"></td>
				<td contenteditable="true" class="item_desc"></td>
				<td contenteditable="true" class="item_price"></td>
				<td name = "remove" class="bt btn-danger btn-xs remove"></td>
			</tr>
		</table>
		<div align="right">
			<button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
		</div>
		<div align="center">
			<button type="button" name="save" id="save" class="btn btn-info">Save</button>
		</div>
		<br/>
		<br/>
		<br/>
		
	</div>
</div>
<div id="inserted_item_data"></div>
</div>
</body>
</html>

<script>
	$(document).ready(function () {
		var count = 1;
		$('#add').click(function(){
			count = count+1;
			var html_code = "<tr id='row"+count+"'>";
			html_code += "<td contenteditable='true' class='item_name'></td>";
			html_code += "<td contenteditable='true' class='item_code'></td>";
			html_code += "<td contenteditable='true' class='item_desc'></td>";
			html_code += "<td contenteditable='true' class='item_price'></td>";
			html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='bt btn-danger btn-xs remove'><i class='icon-remove'></i></button></td>";
			html_code += "</tr>";
			$('#crud_table').append(html_code);
		});
		$(document).on('click', '.remove', function() {
			var delete_row = $(this).data("row");
			$('#' + delete_row).remove();
		});
		$('#save').click(function(){
			var item_name = [];
			var item_code = [];
			var item_desc = [];
			var item_price = [];

			$('.item_name').each(function(){
				item_name.push($(this).text());
			});
				$('.item_code').each(function(){
				item_code.push($(this).text());
			});
				$('.item_desc').each(function(){
				item_desc.push($(this).text());
			});
				$('.item_price').each(function(){
				item_price.push($(this).text());
			});

if (item_name!=''&&item_code!=''&&item_desc!=''&&item_price!='') {

				$.ajax({
					url : "insert.php",
					method : "POST",
					data : {item_name:item_name, item_code:item_code,item_desc:item_desc,item_price:item_price},
					success:function(data)
					{
						$("td[contenteditable='true']").text("");
						for (var i = 2; i <= count; i++) {
							$('tr#'+i+'').remove();
						}
						window.alert("Data Saved Successfully");
						fetch_item_data();
					}
				});
			}
			else
			{
				window.alert("All fields are required");
			}
		});

		function fetch_item_data()
		{
			$.ajax({
				url: "fetch.php",
				method: "POST",
				success: function(data)
				{
					$('#inserted_item_data').html(data);
				}
			})
		}

		fetch_item_data();

	});
</script>