import { createSSRApp } from 'vue';
import { renderToString } from '@vue/server-renderer';
import fs from 'fs';
import path from 'path';
import { compileTemplate, compileScript, parse } from '@vue/compiler-sfc';

const file = fs.readFileSync(path.join(process.cwd(), 'resources/js/Pages/Admin/Zones/Index.vue'), 'utf-8');
const { descriptor } = parse(file);

const script = compileScript(descriptor, { id: 'test' });
const template = compileTemplate({
    source: descriptor.template.content,
    id: 'test',
    compilerOptions: {
        bindingMetadata: script.bindings
    }
});

console.log(template.code);
