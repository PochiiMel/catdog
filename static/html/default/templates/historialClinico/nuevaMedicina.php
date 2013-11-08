<section>
	<fielset>
		<legend>Ingresar Medicina </legend>
		<form action="/catdog/medicinas/guardar" method="POST">
			<table>
				<tr>
					<td>Nombre medicina</td>
					<td>
						<input type="text" name="nombreMedicina" />
					</td>
				</tr>
				<tr>
					<td>Cantidad</td>
					<td><input type="text" name="cantidad" /></td>
				</tr>
				<tr>
					<td>Medida</td>
					<td>
						<select name="idMedida">
							<option value="Mililitros">Mililitros </option>
							<option value="Cajas">Cajas </option>
							<option value="Ampolletas">Ampolletas </option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Registrar Medicina" />
					</td>
				</tr>
			</table>
		</form> 
	</fielset>
</section>