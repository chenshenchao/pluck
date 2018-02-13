import './pluck.scss'

import 'bootstrap'

import './widget/form.coffee'
import './widget/sidebar.coffee'
import './widget/editor.coffee'

# 图标
import fontawesome from '@fortawesome/fontawesome'
import faSave from '@fortawesome/fontawesome-free-solid/faSave'
import faEdit from '@fortawesome/fontawesome-free-solid/faEdit'
import faTrash from '@fortawesome/fontawesome-free-solid/faTrash'
import faSearch from '@fortawesome/fontawesome-free-solid/faSearch'
import faPencilAlt from '@fortawesome/fontawesome-free-solid/faPencilAlt'
import faCaretLeft from '@fortawesome/fontawesome-free-solid/faCaretLeft'
import faAngleDoubleLeft from '@fortawesome/fontawesome-free-solid/faAngleDoubleLeft'
import faAngleDoubleRight from '@fortawesome/fontawesome-free-solid/faAngleDoubleRight'

fontawesome.library.add(
    faSave,
    faEdit,
    faTrash,
    faSearch,
    faPencilAlt,
    faCaretLeft,
    faAngleDoubleLeft,
    faAngleDoubleRight,
)