@extends('layouts.main')

@section('content')
	<div class="row">
		<!-- Articles column -->
		<div class="col-xs-8 col-lg-10">	
			<select id="idArticle" class="form-control">
				<option value="" disabled selected>Selecione un artículo</option>
			</select>
		</div>

		<!-- Amount column -->
		<div id ="idAmount" class="col-xs-4 col-lg-2">
			<select class="form-control">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
				<option>9</option>
				<option>10</option>
			</select>
		</div>
	</div>
@stop