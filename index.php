<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Unit Converter</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<style>
		body {
			font-family: 'Inter', sans-serif;
			-webki-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			background-color: #1a202c;
			color: #e2e8f0
		}
		.custom-scroll::-webkit-scrollbar {
			with: 8px;
		}
		.custom-scroll::-webkit-scrollbar-thumb {
			background-color: #4a5568;
			border-radius: 10px;
		}
		.custom-scroll::-webkit-scrollbar-track {
			background-color: #2d3748;
		}
		/* Hide number input arrows */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
	</style>
	<script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="p-4 flex items-center justify-center min-h-screen">
	<div class="main-container w-full max-w-xl bg-gray-800 p-6 md:p-8 rounded-xl shadow-2xl space-y-6">
		<h1 class="text-3xl font-extrabold text-indigo-400 text-center mb-6">Unit Converter</h1>
		<p class="text-sm text-gray-400 text-center">Select a category and enter a value to convert.</p>
		 <form id="unitConverter">
			<!-- Hidden input to store selected category -->
			<input type="hidden" id="selected-category" name="selected-category" value="">
			<!-- Category selector -->
			<div id="category-selector" class="flex flex-wrap gap-2 justify-center p-3 bg-gray-700 rounded-lg shadow-inner">
				<!-- Category will inject from javascript -->
			</div>
			<!-- Input and output fields -->
			<div class="space-y-4">
				<div class="flex flex-col sm:flex-row gap-3">
					<div class="flex-grow">
						<label for="input-value" class="block text-sm font-medium text-gray-300 mb-1">Convert Form</label>
						<input type="number" id="input-value" name="base-value" placeholder="Enter value" class="w-full p-3 bg-gray-900 border border-gray-700 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-lg text-white transition duration-200" />
					</div>
					<div class="w-full sm:w-40">
						<label for="form-nit" class="block text-sm font-medium text-gray-300 mb-1">Unit</label>
						<select name="base-unit" id="base-unit" class="w-full p-3 bg-gray-900 border border-gray-700 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-lg text-white appearance-none cursor-pointer custom-scroll transition duration-200">
							<!-- Option will inject from javascript -->
						</select>
					</div>
				</div>
				<!-- Swap button -->
				<div class="flex justify-center py-2">
					<button
					id="swap-button"
					type="button"
					onclick="handle_swap()"
					class="p-2 big-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-500 transition duration-300 hover:scale-105"
					title="Swap units">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
					</button>
				</div>
				<!-- Output row -->
				 <div class="flex flex-col sm:flex-row gap-3">
					<div class="flex-grow">
						<label for="output-value" class="block text-sm font-medium text-gray-300 mb-1">Result</label>
						<input
							type="text"
							value=""
							id="output-value"
							placeholder="Converted value"
							readonly
							class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg font-semibold text-lg text-teal-300 cursor-default transition duration-200"
							>
					</div>
					<div class="w-full sm:w-40">
						<label for="to-unit" class="block text-sm font-medium text-gray-300 mb-1">Unit</label>
						<select name="to-unit" id="to-unit" class="w-full p-3 bg-gray-900 border border-gray-700 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-lg appearance-none cursor-pointer custom-scroll transition duration-200">
							<!-- option will be injected by javascript -->
						</select>
					</div>
				 </div>
				 <!-- Submit button -->
				 <div class="">
					<button
						type="submit"
						class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:bg-indigo-500 transition duration-300 hover:scale-105"
						>
						Convert
				 </div>
			</div>
		 </form>
	</div>
</body>
<script>
	document.getElementById("unitConverter").addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch("function.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
		document.getElementById("output-value").value = ' ';
        document.getElementById("output-value").value = data;
		console.log(data);
    });
});
	let categories ={
		"length": {
			"label": "Length",
			"units": ["Meter", "Kilometer", "Centimeter", "Millimeter", "Mile", "Yard", "Foot", "Inch"]
		},
		"weight": {
			"label": "Weight",
			"units": ["Kilogram", "Gram", "Milligram", "Pound", "Ounce"]
		},
		"temperature": {
			"label": "Temperature",
			"units": ["Celsius", "Fahrenheit", "Kelvin"]
		},
		"volume": {
			"label": "Volume",
			"units": ["Liter", "Milliliter", "Cubic Meter", "Cubic Centimeter", "Gallon", "Quart", "Pint", "Cup", "Fluid Ounce"]
		},
		"area":{
			"label": "Area",
			"units": ["Square Meter", "Square Kilometer", "Square Mile", "Acre", "Hectare"]
		},
	}
	const categorySelector = document.getElementById('category-selector');
	const baseUnitSelect = document.getElementById('base-unit');
	const toUnitSelect = document.getElementById('to-unit');
	const inputValue = document.getElementById('input-value');
	const outputValue = document.getElementById('output-value');
	const swapButton = document.getElementById('swap-button');
	let selectedCategory = null;
	//Initilize category buttons
	let currentCategoryKey = 'length';
	function initializeCategorySelector() {
		categorySelector.innerHtml = '';
		Object.entries(categories).forEach(([key, category]) => {
			const input = document.createElement('input');
			input.type = 'button';
			input.value = category.label;
			input.className = 'px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-indigo-600 hover:text-white transition duration-200';
			input.addEventListener('click', () => {
				selectCategory(key);
			});
			categorySelector.appendChild(input);
			if (key === currentCategoryKey) {
				selectCategory(key);
			}
		});
	}
	initializeCategorySelector();
	// Set initial category value
	document.getElementById('selected-category').value = currentCategoryKey;
	//Select category
	function selectCategory(key) {
		selectedCategory = categories[key];
		currentCategoryKey = key;
		document.getElementById('selected-category').value = key;
		updateUnitSelectors();
		highlightSelectedCategory();
	}
	//highlight selected category button
	function highlightSelectedCategory() {
		Array.from(categorySelector.children).forEach((button, index) => {
			if (Object.keys(categories)[index] === currentCategoryKey) {
				button.classList.add('bg-indigo-600', 'text-white');
				button.classList.remove('bg-gray-700', 'text-gray-300');
			} else {
				button.classList.remove('bg-indigo-600', 'text-white');
				button.classList.add('bg-gray-700', 'text-gray-300');
			}
		});
	}
	//Update unit selectors
	function updateUnitSelectors() {
		baseUnitSelect.innerHTML = '';
		toUnitSelect.innerHTML = '';
		if (selectedCategory) {
			selectedCategory.units.forEach(unit => {
				const option1 = document.createElement('option');
				option1.value = unit;
				option1.name = unit;
				option1.textContent = unit;
				baseUnitSelect.appendChild(option1);
				const option2 = document.createElement('option');
				option2.value = unit;
				option2.textContent = unit;
				toUnitSelect.appendChild(option2);
			});
			//Set default selected units
			baseUnitSelect.selectedIndex = 0;
			toUnitSelect.selectedIndex = 1;
		}
	}

	function handle_swap() {
		const fromUnit = baseUnitSelect.value;
		const toUnit = toUnitSelect.value;
		baseUnitSelect.value = toUnit;
		toUnitSelect.value = fromUnit;
	}
</script>
</html>
