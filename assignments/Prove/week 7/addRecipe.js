
function addIngredient()
{
	var ingredentInput = document.getElementById("ingredents");
	var ingredentInputClone = ingredentInput.cloneNode(true);
	document.getElementById("addIngredents").appendChild(ingredentInputClone);
}

function addDirection()
{
	var ingredentInput = document.getElementById("direction");
	var ingredentInputClone = ingredentInput.cloneNode(true);
	ingredentInputClone.value = "";
	document.getElementById("directions").appendChild(ingredentInputClone);

	var b = document.createElement("br");
	document.getElementById("directions").appendChild(b);
}