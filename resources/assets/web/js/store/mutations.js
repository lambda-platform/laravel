export const setState = (state, {
    keyPath,
    data,
    action
}) => {
    let keys = keyPath.split('.');
    let len = keys.length;
    for (var i = 0; i < len - 1; i++) {
        var elem = keys[i];
        if (!state[elem]) state[elem] = {}
        state = state[elem];
    }

    switch (action) {
        case 'set':
            state[keys[len - 1]] = data;
            break;
        case 'add':
            state[keys[len - 1]].unshift(data);
            break;
        case 'update':
            state[keys[len - 1]] = state[keys[len - 1]].map((item) => {
                if (item.id == data.id) {
                    item = data;
                }
                return item;
            })
            break;
        case 'delete':
            state[keys[len - 1]] = state[keys[len - 1]].filter((item) => {
                return item.id != data;
            })
            break;

        case 'updateOption':
            state[keys[len - 1]] = state[keys[len - 1]].map((item) => {
                if (item.value == data.value) {
                    item = data;
                }
                return item;
            })
            break;
        case 'deleteOption':
            state[keys[len - 1]] = state[keys[len - 1]].filter((item) => {
                return item.value != data;
            })
            break;
        default:
            break;
    }
}

export const toggleLoader = (state, key) => {
    state.loaders[key] = !state.loaders[key];
}
