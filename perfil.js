document.addEventListener('DOMContentLoaded', function() {
    const customizeButton = document.getElementById('btn-customize');
    const customizeOptions = document.getElementById('customize-options');
    const buttonShapeSelect = document.getElementById('button-shape');
    const colorPicker = document.getElementById('color-picker');
    const fontSizeSelect = document.getElementById('font-size'); // Nueva línea

    
    function applyStoredPreferences() {
        const storedShape = localStorage.getItem('buttonShape') || 'rounded';
        const storedColor = localStorage.getItem('buttonColor') || '#3498db';
        const storedFontSize = localStorage.getItem('fontSize') || 'medium';
    
        applyButtonShape(storedShape);
        applyButtonColor(storedColor);
        applyFontSize(storedFontSize);
    }
    
    function storePreference(key, value) {
        localStorage.setItem(key, value);
    }

    customizeButton.addEventListener('click', function() {
        customizeOptions.classList.toggle('hidden');
    });

    buttonShapeSelect.addEventListener('change', function() {
        const selectedShape = buttonShapeSelect.value;
        applyButtonShape(selectedShape);
    });

    colorPicker.addEventListener('input', function() {
        const selectedColor = colorPicker.value;
        applyButtonColor(selectedColor);
    });

    fontSizeSelect.addEventListener('change', function() {
        const selectedFontSize = fontSizeSelect.value;
        applyFontSize(selectedFontSize);
    });

    // Funciones auxiliares para aplicar los cambios a los botones
   function applyButtonShape(shape) {
    document.querySelectorAll('button').forEach(button => {
        button.style.borderRadius = shape === 'rounded' ? '5px' : '0';
    });
    storePreference('buttonShape', shape);
}

function applyButtonColor(color) {
    document.querySelectorAll('button').forEach(button => {
        button.style.backgroundColor = color;
    });
    storePreference('buttonColor', color);
}

function applyFontSize(size) {
    const fontSizeMap = {
        'small': '14px',
        'medium': '16px',
        'large': '18px',
    };
    document.body.style.fontSize = fontSizeMap[size];
    storePreference('fontSize', size);
}
});
