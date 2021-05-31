<template>
    <section class="page">
        <krud :template="property.template" :property="property" class="material">
            <template slot="nav">
                <slot name="nav"></slot>
            </template>

            <template slot="v-nav">
                <slot name="v-nav"></slot>
            </template>

            <template slot="right">
                <slot name="user"></slot>
            </template>
        </krud>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                openSlidePanel: false,
                item: null,
                operands: [],
                schedule: {
                    operand: null,
                    item: null
                }
            };
        },
        created() {
            this.init();
        },
        computed: {
            property() {
                return {
                    template: "list",
                    title: this.$route.params.title,
                    grid: this.$route.params.schema,
                    dbClickAction: this.checkItem
                };
            }
        },
        methods: {
            init() {
                axios.get("/logistic/step/users/12").then(o => {
                    this.operands = o.data;
                });
            },

            scheduleItem() {
                axios.post("/logistic/step/schedule", this.schedule).then(o => {
                    alert("Мэдээлэл амжилттай хувиарлагдлаа!");
                    this.openSlidePanel = false;
                });
            },

            rejectItem() {
                axios.get("/logistic/step/reject/" + this.schedule.item).then(o => {
                    alert("Мэдээлэл буцаагдлаа!");
                });
            },

            checkItem(data) {
                this.openSlidePanel = true;
                this.item = null;
                this.schedule.item = data.id;

                axios.get("/logistic/PriceCrudCargo/detail/" + data.id).then(o => {
                    this.item = o.data;
                    this.item = o.data.data[0];
                    this.item["baraalist"] = o.data.baraalist;
                });
            },
            gotoEdit(id) {
                this.$router.push("/logistic/cargoburtgel/edit/" + id);
            }
        }
    };
</script>
