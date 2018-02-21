import './pluck.scss'

import 'bootstrap'

import './widget/form.coffee'
import './widget/sidebar.coffee'
import './widget/editor.coffee'

# 图标
import fontawesome from '@fortawesome/fontawesome'
import faKey from '@fortawesome/fontawesome-free-solid/faKey'
import faSave from '@fortawesome/fontawesome-free-solid/faSave'
import faEdit from '@fortawesome/fontawesome-free-solid/faEdit'
import faUser from '@fortawesome/fontawesome-free-solid/faUser'
import faTrash from '@fortawesome/fontawesome-free-solid/faTrash'
import faSearch from '@fortawesome/fontawesome-free-solid/faSearch'
import faIdCard from '@fortawesome/fontawesome-free-solid/faIdCard'
import faIdBadge from '@fortawesome/fontawesome-free-solid/faIdBadge'
import faUserPlus from '@fortawesome/fontawesome-free-solid/faUserPlus'
import faPencilAlt from '@fortawesome/fontawesome-free-solid/faPencilAlt'
import faCaretLeft from '@fortawesome/fontawesome-free-solid/faCaretLeft'
import faSignOutAlt from '@fortawesome/fontawesome-free-solid/faSignOutAlt'
import faAngleDoubleLeft from '@fortawesome/fontawesome-free-solid/faAngleDoubleLeft'
import faAngleDoubleRight from '@fortawesome/fontawesome-free-solid/faAngleDoubleRight'

import faSuperPowers from '@fortawesome/fontawesome-free-brands/faSuperPowers'

fontawesome.library.add(
    faKey,
    faSave,
    faEdit,
    faUser,
    faTrash,
    faSearch,
    faIdCard,
    faIdBadge,
    faUserPlus,
    faPencilAlt,
    faCaretLeft,
    faSignOutAlt,
    faAngleDoubleLeft,
    faAngleDoubleRight,

    faSuperPowers,
)