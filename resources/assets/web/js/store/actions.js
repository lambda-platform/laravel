/**
 * Created by n0m4dz on 5/29/17.
 */
import axios from 'axios';
import {
    Message
} from 'iview'

export const dt = ({
    commit
}, payload) => {
    console.log(payload);
    commit('toggleLoader', payload.loader);
    axios[payload.type](payload.url, payload.data)
        .then(o => {
            if (o.data.status) {
                commit('toggleLoader', payload.loader);
                let commitData = {
                    action: payload.action,
                    keyPath: payload.keyPath,
                    data: o.data.data
                }
                commit(payload.mutation, commitData);
                if ('msg' in o.data) {
                    Message.info(o.data.msg);
                }
            } else {
                Message.error(o.data.msg);
            }
        })
        .catch(error => {
            console.log(error);
            commit('toggleLoader', payload.loader);
            Message.error("Сервэрт алдаа гарлаа!");
        });
}
