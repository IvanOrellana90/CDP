<template>
	<div id="demo-card-analytics">
        <!-- ROW 1 -->
        <div class="vx-row">

			<div class="vx-col w-full lg:w-1/2 sm:w-1/2 mb-base">
                <vx-card :title="organization">
					<p>Elige organización si quieres ingresar información de organizaciones populares como juntas de vecinos, asambleas territoriales, corporaciones o fundaciones. También puedes ingresar información de instituciones públicas e iniciativas de ayuda del mundo empresarial. </p>
					<vs-button @click="redirectOrganization()" class="w-full mt-5" color="primary" type="gradient">Organización</vs-button>
                </vx-card>
            </div>

			<div class="vx-col w-full lg:w-1/2 sm:w-1/2 mb-base">
                <vx-card :title="event">
					<p>Elige actividad si quieres ingresar información sobre una olla común o una actividad que toma lugar una o varias veces. Si el evento depende de una organización, podrás ingresar la información de la organización aquí mismo.</p>
					<vs-button @click="redirectEvent()" class="w-full mt-5" color="primary" type="gradient">Actividad</vs-button>
                </vx-card>
            </div>

        </div>
	</div>

</template>

<script>
export default {
  data() {
    return {
      event: "Nueva actividad",
      organization: "Nueva organización",
    }
  },
  methods: {
    redirectOrganization () {
      this.$router.push("new-organization")
    },
    redirectEvent () {
        this.$router.push("new-event")
    },
  }
}
</script>