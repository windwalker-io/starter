import {
  useBs5Tooltip,
  useCheckboxesMultiSelect,
  useDisableOnSubmit,
  useGridComponent,
} from '@windwalker-io/unicorn-next';

const formSelector = '#admin-form';

useBs5Tooltip();

useGridComponent(formSelector);

useDisableOnSubmit(formSelector);

useCheckboxesMultiSelect(formSelector);
