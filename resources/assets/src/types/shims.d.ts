import { UnicornApp } from '@windwalker-io/unicorn-next';

declare module '*.scss' {
  const content: { [className: string]: string }
  export default content
}

declare module '*.scss?inline' {
  export default string;
}

declare module '*.css' {
  export default string;
}

declare module '*.css?inline' {
  export default string;
}

declare module '*.vue' {
  import { defineComponent } from 'vue'
  const component: ReturnType<typeof defineComponent>
  export default component;
}
