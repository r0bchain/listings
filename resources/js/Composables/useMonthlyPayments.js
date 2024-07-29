
import {computed, isRef} from 'vue'

export const useMonthlyPayments = (total, interestRate, duration) => {

    const monthlyPayment = computed(() => {

        const principle = isRef(total) ? total.value : total
        const monthlyInterestRate = (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12
        const numberOfPaymentMonths = (isRef(duration) ? duration.value : duration) * 12
      
        return principle * monthlyInterestRate * (Math.pow(1 + monthlyInterestRate, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterestRate, numberOfPaymentMonths) - 1)
    
    })

    const totalPaid = computed(() => {
        return (isRef(duration) ? duration.value : duration) * 12 * monthlyPayment.value;
    });

    const totalInterest = computed(() => {
        return totalPaid.value - (isRef(total) ? total.value : total);
    }); 

    return {monthlyPayment, totalPaid, totalInterest}
}