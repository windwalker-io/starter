import '@main';

u.$ui.bootstrap.tooltip();

const formSelector = '#admin-form';

// Init Grid
u.grid(formSelector).initComponent();

// Disable on submit
u.$ui.disableOnSubmit(formSelector);

// Checkbox Multi-select
u.$ui.checkboxesMultiSelect(formSelector);
