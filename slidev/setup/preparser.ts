import { definePreparserSetup } from '@slidev/types'
import { readFileSync, writeFileSync } from 'fs'

// https://sli.dev/custom/config-parser.html#use-case-2-using-custom-frontmatter-to-wrap-slides
// FIXME: TS warnings on parameters

export default definePreparserSetup(( { filepath, headmatter } ) => {

    return [
        {
            transformSlide(content, frontmatter) {
                let extra = headmatter?.xp?.slide_append

                // check content has no line starting with '# '
                if (content.split('\n').some(line => line.startsWith('# '))) {
                    extra = false
                }
                if (extra) {
                    return [
                        '',
                        content,
                        '',
                        headmatter.xp.slide_append,
                    ].join('\n')
                }
            },
        },
    ]
})